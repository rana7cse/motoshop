<?php

class PaySupp extends Eloquent
{
    protected $table = "supplier_payment";

    protected $fillable = array('supplier_id','order_id','comment','ammount','date');
}