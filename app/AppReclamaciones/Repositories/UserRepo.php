<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 28/12/2015
 * Time: 8:41 AM
 */

namespace AppReclamaciones\Repositories;
use AppReclamaciones\Entities\User;

class UserRepo extends BaseRepo
{
    public function getModel(){
        return new User();
    }
    public function getAll(){
        return User::all();
    }
    public function find($id){
        return User::findOrFail($id);
    }
}