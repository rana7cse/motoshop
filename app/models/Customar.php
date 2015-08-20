<?php

class Customar extends Eloquent
{
    protected $table = "customars";

    protected $fillable = array('first_name','last_name','address','phone','phone2','email','nid_no');
}