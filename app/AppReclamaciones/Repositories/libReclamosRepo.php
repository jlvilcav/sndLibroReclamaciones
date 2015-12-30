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
        //return dd($inputs);
        $obj = new perNatural;
        $obj->IDX_NUM_DOCU = $inputs['IDX_NUM_DOCU'];
        $obj->NOMBRE = $inputs['NOMBRE'];
        $obj->APE_PAT = $inputs['APE_PAT'];
        $obj->APE_MAT = $inputs['APE_MAT'];
        $obj->IDX_UBIGEO = $inputs['IDX_UBIGEO'];
        $obj->IDX_TIPDOC = $inputs['IDX_TIPDOC'];
        $obj->DOMICILIO = $inputs['DOMICILIO'];
        $obj->EMAIL = $inputs['EMAIL'];
        $obj->TEL_FIJO = $inputs['TEL_FIJO'];
        $obj->NUM_CELU = $inputs['NUM_CELU'];
        $obj->IDX_USUA_CREA = $inputs['IDX_USUA_CREA'];
        $obj->FEC_USUA_CREA = $inputs['FEC_USUA_CREA'];
        $obj->DES_TERM_CREA = $inputs['DES_TERM_CREA'];
        $obj->IDX_USUA_MODI = $inputs['IDX_USUA_MODI'];
        $obj->FEC_USUA_MODI = $inputs['FEC_USUA_MODI'];
        $obj->DES_TERM_MODI = $inputs['DES_TERM_MODI'];
        $obj->BIT_ACTIVO = $inputs['BIT_ACTIVO'];

        $obj->save();
        return $obj->IDX_NAT;
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