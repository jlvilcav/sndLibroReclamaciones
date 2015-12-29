<?php
use AppReclamaciones\Repositories\libReclamosRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 9:45 AM
 */
class libReclamosController extends BaseController
{
    protected $libReclamosRepo;
    public function __construct(libReclamosRepo $libReclamosRepo){
        $this->libReclamosRepo =  $libReclamosRepo;
    }
    public function index(){
        return $this->libReclamosRepo->getAll();
    }
    public function add(){
        return $this->libReclamosRepo->add();
    }
    public function mostrarForm(){
        echo 'hola mundo controller<br>';
        return $this->mostrarFormX();
    }
}