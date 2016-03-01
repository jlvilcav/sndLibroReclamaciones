<?php
namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\libReclamos;
use AppReclamaciones\Repositories\ubigeosRepo;
use AppReclamaciones\Repositories\tipDocumentoRepo;
use AppReclamaciones\Repositories\perNaturalRepo;
use AppReclamaciones\Repositories\perJuridicaRepo;

class libReclamosRepo extends BaseRepo
{
    public function getModel(){
        return new libReclamos;
    }
    public function getAll(){
        return libReclamos::all();
    }
    public function find($id){
        return libReclamos::find($id);
    }
    public function add(){
        $inputs = $this->getInputs();
        if(isset($inputs['IDX_NUM_DOCU']) && strlen(trim($inputs['IDX_NUM_DOCU']))){  
            $personaBuscar = \DB::table('pernatural')->where('IDX_NUM_DOCU',$inputs['IDX_NUM_DOCU'])->first();
        }else{
            $personaBuscar = \DB::table('perjuridica')->where('IDX_NUM_DOCU',$inputs['IDX_NUM_DOCU_RUC'])->first();
        }
        //return dd($personaBuscar);

        if(!isset($personaBuscar->IDX_NUM_DOCU)){
            if(isset($inputs['IDX_NUM_DOCU']) && strlen(trim($inputs['IDX_NUM_DOCU']))){
                $persona = new perNaturalRepo;
                $flagPersona = 'N';
            }else{
                $persona = new perJuridicaRepo;
                $flagPersona = 'J';
            }
            $idPersona = $persona->add($inputs);
        }else{
            if(isset($inputs['IDX_NUM_DOCU']) && strlen(trim($inputs['IDX_NUM_DOCU']))){
                $idPersona = $personaBuscar->IDX_NAT;
                $flagPersona = 'N';
            }else{
                $idPersona = $personaBuscar->IDX_JUR;
                $flagPersona = 'J';
            }                   
        }
        $inputs['idPersona'] = $idPersona;
        $inputs['flagPersona'] = $flagPersona;
        return $this->addReclamo($inputs);
    }
    public function addReclamo($inputs){
        $objReclamo = new libReclamos;
        if($inputs['flagPersona'] == 'N'){
            $objReclamo->IDX_NUM_DOCU_NAT = $inputs['idPersona'];
        }else{
            $objReclamo->IDX_NUM_DOCU_JUR = $inputs['idPersona'];
        }
        $objReclamo->FLAG_PERSONA = $inputs['flagPersona'];
        $objReclamo->DES_IDE_ATEN = $inputs['DES_IDE_ATEN'];
        $objReclamo->DES_ACC_ADOP = $inputs['DES_ACC_ADOP'];
        $objReclamo->IDX_USUA_CREA = 405;
        $objReclamo->FEC_USUA_CREA = date('Y-m-d H:i:s');
        $objReclamo->DES_TERM_CREA = '';
        $objReclamo->IDX_USUA_MODI = 1;
        $objReclamo->FEC_USUA_MODI = date('Y-m-d H:i:s');
        $objReclamo->DES_TERM_MODI = '';
        $objReclamo->BIT_ACTIVO = 1;
        if($objReclamo->save()){            
            $idReclamo = $objReclamo->id;
            $numReclamo = str_pad($objReclamo->id,5,'0',STR_PAD_LEFT).'-'.date('Y').'-RV';
            \DB::table('libreclamos')->where('IDX_LIB_REC',$idReclamo)
                                     ->update(array('NUM_RECLAM' => $numReclamo));
            $arResult = array(
                'mensaje' => 'Su reclamo ha sido generado: '.$numReclamo.'
Hemos recibido su reclamo satisfacoriamente. 
Una copia del reclamo ha sido enviado a su correo electrónico.
Le brindamos una respuesta en un plazo máximo de 30 (treinta) días hábiles.
De tener alguna consulta Puede escribirnos a consultas@Sunedu.gob.pe
Gracias.
Responsable del Libro de Reclamaciones',
                'estado' => true
            );
            if($inputs['flagPersona']){
                if($inputs['flagPersona'] == 'N'){
                    $this->sendEmail = $inputs['EMAIL'];
                }else{
                    $this->sendEmail = $inputs['EMAILJ'];
                }

                $this->rutaPDF = asset('/pdf/'.$idReclamo.'/x.pdf'); //'/x.pdf'); '/'.$numReclamo.'.pdf');
                $data = array();                
                \Mail::send('emails.reclamo.parrafo', $data, function($message)
                {
                    $message->to($this->sendEmail, 'SUNEDU')
                                        ->cc('reclamos@sunedu.gob.pe')
                                        ->subject('SUNEDU - Formulario de Reclamación');
                    $message->attach($this->rutaPDF);
                });
            }
            return $arResult;
        }else{
            $arResult = array(
                'mensaje' => 'Hubo un problema por favor vuelva a intentarlo',
                'estado' => true
            );
            return $arResult;
        }

    }
    public function generarPDF($id){
        $objReclamo = \DB::table('libreclamos')->where('IDX_LIB_REC','=',$id)->first();
        //dd($objReclamo);
        if($objReclamo->FLAG_PERSONA == 'N'){
            $personaBuscar = \DB::table('pernatural')->where('IDX_NAT',$objReclamo->IDX_NUM_DOCU_NAT)->first();
            $nombreCompleto = $personaBuscar->NOMBRE.' '.$personaBuscar->APE_PAT.' '.$personaBuscar->APE_MAT;
            $domicilio = $personaBuscar->DOMICILIO;
            $nro_doc = $personaBuscar->IDX_NUM_DOCU;
            $telf_email = $personaBuscar->TEL_FIJO.' / '.$personaBuscar->NUM_CELU.' / '.$personaBuscar->EMAIL;
        }else{            
            $personaBuscar = \DB::table('perjuridica')->where('IDX_JUR',$objReclamo->IDX_NUM_DOCU_JUR)->first();       
            $nombreCompleto = $personaBuscar->RAZ_SOCIAL;
            $domicilio = $personaBuscar->DOMICILIO;
            $nro_doc = $personaBuscar->IDX_NUM_DOCU;
            $telf_email = $personaBuscar->TEL_FIJO.' / '.$personaBuscar->EMAIL;
        }
        $data = array(
            'fecha' => $objReclamo->FEC_USUA_CREA,
            'nro_reclamo' => $objReclamo->NUM_RECLAM,
            'nombre' => $nombreCompleto,
            'domicilio' => $domicilio,
            'num_doc' => $nro_doc,
            'telf_email' => $telf_email,
            'atencion_brindada' => $objReclamo->DES_IDE_ATEN
        );  
        $pdf = \PDF::loadView('emails.reclamo.pdfGenerado', $data);
        return $pdf->stream('Reclamacion.pdf');    
    }
    public function mostrarFormX(){
        $objTipDoc = new tipDocumentoRepo;
        $objPais = new ubigeosRepo;
        $data = array(
            'tipo_doc' => $objTipDoc->listaCombo(),
            'pais' => $objPais->listaDepa(),
        );
        return \View::make('nuevoReclamo',$data);
    }
}