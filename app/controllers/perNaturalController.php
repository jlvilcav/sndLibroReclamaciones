<?php
use AppReclamaciones\Repositories\perNaturalRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 9:34 AM
 */
class perNaturalController extends BaseController
{
    protected $perNaturalRepo;
    public function __construct(perNaturalRepo $perNaturalRepo){
        $this->perNaturalRepo =  $perNaturalRepo;
    }
    public function index(){
        return $this->perNaturalRepo->getAll();
    }
    public function add(){
        return $this->perNaturalRepo->add();
    }
    public function findByDni($dni){
        return $this->perNaturalRepo->findByDni($dni);
    }
}