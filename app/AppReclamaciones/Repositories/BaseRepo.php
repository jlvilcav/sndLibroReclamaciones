<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 23/12/2015
 * Time: 5:56 PM
 */

namespace AppReclamaciones\Repositories;


abstract  class BaseRepo
{
    protected $model;
    public $inputs;
    public function __construct(){
        $this->model = $this->getModel();
    }
    abstract function getModel();
    public function find($id){
        return $this->model->find($id);
    }
    public function getInputs(){
        return \Input::all();
    }
}