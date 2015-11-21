<?php

class PaymentReceive extends \Eloquent {
	protected $fillable = ["car_sold_id","cus_id","paid","interest","due_date","transection_id","comment"];
	protected $table = "customar_payment";
}