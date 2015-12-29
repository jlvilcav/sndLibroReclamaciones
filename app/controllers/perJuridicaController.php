<?php

use AppReclamaciones\Repositories\perJuridicaRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 9:30 AM
 */
class perJuridicaController extends BaseController
{
    protected $perJuridicaRepo;
    public function __construct(perJuridicaRepo $perJuridicaRepo){
        $this->perJuridicaRepo =  $perJuridicaRepo;
    }
    public function index(){
        return $this->perJuridicaRepo->getAll();
    }
    public function add(){
        return $this->perJuridicaRepo->add();
    }
}