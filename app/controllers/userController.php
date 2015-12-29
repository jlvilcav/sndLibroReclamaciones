<?php
use AppReclamaciones\Repositories\UserRepo;
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 10:10 AM
 */
class userController extends BaseController
{
    protected $UserRepo;
    public function __construct(UserRepo $UserRepo){
        $this->UserRepo =  $UserRepo;
    }
    public function index(){
        return $this->UserRepo->getAll();
    }
    public function add(){
        return $this->UserRepo->add();
    }
}