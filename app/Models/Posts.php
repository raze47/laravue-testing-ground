<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id'
    ];


    public function Users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function PostsComments(){
        return $this->hasMany('App\Models\PostsComments');
    }

}


