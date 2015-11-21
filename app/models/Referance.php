<?php

class Referance extends \Eloquent {
	protected $fillable = ['ref_name','Father_Name','address','thana','zilla','division','country','contact','contact2'];
	protected $table = "referance";
}