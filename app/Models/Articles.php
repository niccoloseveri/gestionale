<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected $dates = ['data_p', 'ora_p', 'created_at','updated_at'];
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    public function topic(){
        return $this->belongsToMany('App\Models\Topic');
    }
}
