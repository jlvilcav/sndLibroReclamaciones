<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 8:26 AM
 */

namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\perJuridica;


class perJuridicaRepo extends BaseRepo
{
    public function getModel(){
        return new perJuridica();
    }
    public function getAll(){
        return libReclamos::all();
    }
    public function find($id){
        return libReclamos::find($id);
    }
    public function findByRuc($ruc){
        return \DB::table('perjuridica')
            ->join('ubigeos', 'perjuridica.IDX_UBIGEO', '=', 'ubigeos.IDX_UBIGEO')
            ->select('perjuridica.*', 'ubigeos.*')
            ->where('perjuridica.IDX_NUM_DOCU','=',$ruc)
            ->get();
    }    
    public function add(){
        $inputs = $this->getInputs();
        //return dd($inputs);
        $obj = new perJuridica;
        $obj->IDX_NUM_DOCU = $inputs['IDX_NUM_DOCU_RUC'];
        $obj->RAZ_SOCIAL = $inputs['RAZ_SOCIAL'];
        $obj->IDX_UBIGEO = $inputs['IDX_UBIGEOJ'];
        $obj->IDX_TIPDOC = 4; //RUC
        $obj->DOMICILIO = $inputs['DOMICILIOJ'];
        $obj->EMAIL = $inputs['EMAILJ'];
        $obj->TEL_FIJO = $inputs['TELEFONOJ'];
        $obj->IDX_USUA_CREA = 405;
        $obj->FEC_USUA_CREA = date('Y-m-d H:i:s');
        $obj->DES_TERM_CREA = '';
        $obj->IDX_USUA_MODI = 1;
        $obj->FEC_USUA_MODI = date('Y-m-d H:i:s');
        $obj->DES_TERM_MODI = '';
        $obj->BIT_ACTIVO = 1;
        $obj->save();
        return $obj->IDX_NAT;
    }
}