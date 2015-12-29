<?php
use AppReclamaciones\Repositories\tipDocumentoRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 9:58 AM
 */
class tipDocuController extends BaseController
{
    protected $tipDocumentoRepo;
    public function __construct(tipDocumentoRepo $tipDocumentoRepo){
        $this->tipDocumentoRepo =  $tipDocumentoRepo;
    }
    public function index(){
        return $this->tipDocumentoRepo->getAll();
    }
    public function add(){

        return $this->tipDocumentoRepo->add();
    }
    public function mostrarForm(){

        return $this->tipDocumentoRepo->mostrarLista();
    }
}