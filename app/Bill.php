<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    public $timestamps = true;
    protected $fillable = ['price','type','user_id'];
    public function greens(){
        return $this->belongsToMany('App\Greens','greens_bill','bill_id','greens_id')->withPivot('num');
    }
}
