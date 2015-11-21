<?php

class Sell extends Eloquent {

	protected $table = 'moto_sold';
	protected $fillable = ['inv_id','cus_id','ref_id','price','vat','bank_int','sold_date','payment_status','installments','total_billed','paid','due'];

}