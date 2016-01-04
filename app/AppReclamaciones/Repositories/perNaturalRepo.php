<?php
namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\perNatural;

class perNaturalRepo extends BaseRepo{
    public function getModel(){
        return new perNatural();
    }
    public function getAll(){
        return perNatural::all();
    }
    public function find($id){
        return perNatural::find($id);
    }
    public function findByDni($dni){
        return \DB::table('pernatural')
            ->join('ubigeos', 'perNatural.IDX_UBIGEO', '=', 'ubigeos.IDX_UBIGEO')
            ->select('pernatural.*', 'ubigeos.*')
            ->where('pernatural.IDX_NUM_DOCU','=',$dni)
            ->get();
    }
    public function add($inputsE){
        $inputs = $this->getInputs() ? $this->getInputs() : $inputsE ;
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
        $obj->IDX_USUA_CREA = 405;
        $obj->FEC_USUA_CREA = date('Y-m-d H:i:s');
        $obj->DES_TERM_CREA = '';
        $obj->IDX_USUA_MODI = 1;
        $obj->FEC_USUA_MODI = date('Y-m-d H:i:s');
        $obj->DES_TERM_MODI = '';
        $obj->BIT_ACTIVO = 1;
        $obj->save();
        return $obj->id; //retorna el id de la persona natural
    }
}