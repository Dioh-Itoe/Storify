<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function story(){
        return $this->hasMany('App\Models\Story', 'category_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
