<?php

/**
 * Created by PhpStorm.
 * User: rana7cse
 * Date: 8/3/2015
 * Time: 2:40 PM
 */
class Customar extends Eloquent
{
    protected $table = "customars";

    protected $fillable = array('first_name','last_name','address','phone','phone2','email','nid_no');
}