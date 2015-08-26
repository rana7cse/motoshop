<?php

class Sell extends Eloquent {

	protected $table = 'moto_sold';
	protected $fillable = ['inv_id','cus_id','price','sold_date','payment_status','installments','paid','due'];

}