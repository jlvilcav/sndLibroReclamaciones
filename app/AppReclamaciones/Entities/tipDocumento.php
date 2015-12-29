<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 23/12/2015
 * Time: 12:16 PM
 */

namespace AppReclamaciones\Entities;


class tipDocumento extends \Eloquent
{
    protected $table = 'tipDocumento';
    protected $hidden = array('password', 'remember_token');
}