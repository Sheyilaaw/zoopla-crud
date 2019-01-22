<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Property extends Eloquent {

    protected $table = 'property';

    protected $fillable = [ 'username' , 'email' ];

}