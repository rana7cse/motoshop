<?php

/**
 * Created by PhpStorm.
 * User: rana7cse
 * Date: 7/31/2015
 * Time: 2:32 AM
 */
class Inventory extends Eloquent
{
    protected $table = 'inventory';

    protected $fillable = array('product_id','eng_no','chs_no','is_sell','color','quantity','buy_rate','sell_rate','comision_tk','img','item_no','supplyir_id');

}