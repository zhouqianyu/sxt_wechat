<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';
    protected $fillable = ['greens_id','user_id','num'];
    public $timestamps = false;
}
