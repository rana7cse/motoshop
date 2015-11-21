<?php

class Customar extends Eloquent
{
    protected $table = "customars";

    protected $fillable = array('first_name','fat_name','address','thana','zilla','division','phone','phone2','email');

    public function buy(){
        return $this->hasMany('Sell','cus_id');
    }
}