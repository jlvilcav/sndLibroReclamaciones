<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 23/12/2015
 * Time: 8:26 AM
 */

namespace AppReclamaciones\Entities;


class Ubigeos extends \Eloquent
{
    protected $table = 'ubigeos';
    protected $hidden = array('password', 'remember_token');
}