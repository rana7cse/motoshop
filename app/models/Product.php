<?php

class Product extends Eloquent
{
    protected $table = 'product';
    protected $fillable = array('product_name','bike_cc','model');
}