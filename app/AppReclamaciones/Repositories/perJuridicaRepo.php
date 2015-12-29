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
        return libReclamos::findOrFail($id);
    }
}