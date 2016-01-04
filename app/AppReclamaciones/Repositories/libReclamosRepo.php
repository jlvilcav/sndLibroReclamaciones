<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 8:31 AM
 */

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
        $persona = new perNaturalRepo;
        $idPersona = $persona->add($inputs);
        $inputs['idPersona'] = $idPersona;
        //dd($idPersona);
        return $this->addReclamo($inputs);
    }
    public function addReclamo($inputs){
        $objReclamo = new libReclamos;
        $objReclamo->IDX_NUM_DOCU_NAT = $inputs['idPersona'];
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
        $objReclamo->save();
        $idReclamo = $objReclamo->id;



        $numReclamo = str_pad($objReclamo->id,5,'0',STR_PAD_LEFT).'-'.date('Y').'-RV';
        \DB::table('libreclamos')->where('IDX_LIB_REC',$idReclamo)
                                 ->update(array('NUM_RECLAM' => $numReclamo));

        return $numReclamo;
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