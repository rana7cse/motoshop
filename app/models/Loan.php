<?php

class Loan extends \Eloquent {
	protected $table = 'car_loan';
	protected $fillable = ['sold_id', 'rate', 'total_inst', 'current_inst', 'current_paid', 'current_due', 'next_pay_date', 'end_date'];
}