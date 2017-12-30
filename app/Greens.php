<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Greens extends Model
{
    protected $table = 'greens';
    public $timestamps = false;
    public function bills(){
        return $this->belongsToMany('App\greens','greens_bill','greens_id','bill_id')->withPivot('num');
    }
}
