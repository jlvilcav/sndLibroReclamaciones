<?php
use AppReclamaciones\Repositories\ubigeosRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 10:03 AM
 */
class ubigeosController extends BaseController
{
    protected $ubigeosRepo;
    public function __construct(ubigeosRepo $ubigeosRepo){
        $this->ubigeosRepo =  $ubigeosRepo;
    }
    public function index(){
        return $this->ubigeosRepo->getAll();
    }
    public function add(){
        return $this->ubigeosRepo->add();
    }
}