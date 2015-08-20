<?php

class Order extends Eloquent
{
    protected $table = "pro_buy_info";

    protected $fillable = array('supplier_id','comment','ammount','pay','due','date');
}