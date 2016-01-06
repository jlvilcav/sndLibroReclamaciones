<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 8:36 AM
 */

namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\tipDocumento;

class tipDocumentoRepo extends BaseRepo
{
    public function getModel(){
        return new tipDocumento;
    }
    public function getAll(){
        return tipDocumento::all();
    }
    public function find($id){
        return tipDocumento::findOrFail($id);
    }
    public function listaCombo(){
    	$obTipDoc = new tipDocumentoRepo;
    	$tipDocList = \DB::table('tipdocumento')
    							->select('IDX_TIPDOC','DES_TIPDOC')
    							->where('BIT_ACTIVO', '=', 1)
    							->get();
    							
    	return $tipDocList;
    }
}