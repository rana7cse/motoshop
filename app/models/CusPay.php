<?php


class CusPay extends Eloquent {

    protected $table = 'customar_payment';
    protected $fillable = ['car_sold_id','cus_id','paid','interest','transection_id','due_date','comment'];

}