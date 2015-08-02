<?php

class Product extends Eloquent
{
    protected $table = 'product';
    protected $fillable = array('product_name','product_visibility','product_img');
}