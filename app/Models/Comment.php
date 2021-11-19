<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements Likeable
{
    use HasFactory;
    use Likes;

    protected $guarded = [];

    public function commentable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'commentable');
    }

    // public function parent(){
    // return $this->belongsTo('App\Models\Comment', 'parent_id');
    // }

    public function replies(){
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }
   
}
