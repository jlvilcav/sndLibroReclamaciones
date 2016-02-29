<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 23/12/2015
 * Time: 12:20 PM
 */

namespace AppReclamaciones\Entities;


class perJuridica extends \Eloquent
{
    protected $table = 'perjuridica';
    protected $hidden = array('password', 'remember_token');
}