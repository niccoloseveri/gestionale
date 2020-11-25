<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['t_name'];
    public function article(){
        return $this->belongsToMany('App\Models\Articles');
    }
}
