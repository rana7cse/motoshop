<?php

/**
 * Created by PhpStorm.
 * User: rana7cse
 * Date: 8/8/2015
 * Time: 1:12 AM
 */
class Supplier extends Eloquent
{
    protected $table = 'supplier';

    protected $fillable = array('supp_name','supp_type','supp_add','supp_mgm','contact_f','contact_s','email');
}