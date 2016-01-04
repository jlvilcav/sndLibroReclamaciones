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
        $objReclamo->FLAG_PERSONA = 'N';
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
                'mensaje' => 'Su reclamo ha sido generado: '.$numReclamo,
                'estado' => true
            );
            return $arResult;
        }else{
            $arResult = array(
                'mensaje' => 'Hubo un problema por favor vuelva a intentarlo',
                'estado' => true
            );
            return $arResult;
        }

    }
    public function mostrarFormX(){
        $objTipDoc = new tipDocumentoRepo;
        $objPais = new ubigeosRepo;
        //$objProv = new ubigeosRepo;
        $data = array(
            'tipo_doc' => $objTipDoc->listaCombo(),
            'pais' => $objPais->listaDepa(),
            //'provincia' => $objProv -> listaProv()
        );
        return \View::make('nuevoReclamo',$data);
    }
}