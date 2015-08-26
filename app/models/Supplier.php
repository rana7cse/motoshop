<?php

class Supplier extends Eloquent
{
    protected $table = 'supplier';

    protected $fillable = array('supp_name','supp_type','supp_add','supp_mgm','contact_f','contact_s','email');
}