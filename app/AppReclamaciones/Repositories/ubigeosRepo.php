<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 8:39 AM
 */

namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\Ubigeos;

class ubigeosRepo extends BaseRepo
{
    public function getModel(){
        return new Ubigeos();
    }
    public function getAll(){
        return Ubigeos::all();
    }
    public function getDiez(){
        return \DB::table('ubigeos')->where('IDX_UBIGEO','<','10')->get();
    }
    public function find($id){
        return Ubigeos::findOrFail($id);
    }
}