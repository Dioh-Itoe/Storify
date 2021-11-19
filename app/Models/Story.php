<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model implements Likeable
{
    use HasFactory;
    use Likes;
    protected $guarded = [];

    public function users(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function imageable(){
        return $this->morphMany('App\Models\Images', 'imageable');
    }
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function edit(){
        return url("/dashboard/stories/edit/{$this->slug}");
    }
}
