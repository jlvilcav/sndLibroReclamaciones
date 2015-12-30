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

    public function listaDepa(){
        $obUbiPais = new ubigeosRepo;
        $ubiPais = \DB::table('ubigeos')
                                ->select('COD_DEPA_CONTINENTE','DES_DEPA_CONTINENTE')
                                ->distinct()
                                ->where('BIT_ACTIVO', '=', 1)
                                ->get();
                                
        return  $ubiPais;
    }
    public function listaProv($id){
        $obUbiPais = new ubigeosRepo;
        $ubiPais = \DB::table('ubigeos')
                                ->select('COD_PROV_PAIS','DES_PROV_PAIS')
                                ->distinct()
                                ->where('BIT_ACTIVO', '=', 1)
                                ->where('COD_DEPA_CONTINENTE', '=', $id )                                
                                ->get();
                                
        return  $ubiPais;
    }
    public function listaDist($id){
        $obUbiPais = new ubigeosRepo;
        $ubiPais = \DB::table('ubigeos')
                                ->select('COD_DIST_CIUDAD','DES_DIST_CIUDAD')
                                ->distinct()
                                ->where('BIT_ACTIVO', '=', 1)
                                ->where('COD_PROV_PAIS', '=', $id )                                
                                ->get();
                                
        return  $ubiPais;
    }


}