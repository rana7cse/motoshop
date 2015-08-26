<?php


class CusPay extends Eloquent {

    protected $table = 'customar_payment';
    protected $fillable = ['car_sold_id','cus_id','paid','interest','due_date','comment'];

}