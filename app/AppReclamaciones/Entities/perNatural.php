<?php
/**
 * Created by PhpStorm.
 * User: WebMaster
 * Date: 23/12/2015
 * Time: 12:19 PM
 */

namespace AppReclamaciones\Entities;


class perNatural extends \Eloquent
{
    protected $table = 'perNatural';
	protected $fillable = array('id');
    protected $hidden = array('password', 'remember_token');
}