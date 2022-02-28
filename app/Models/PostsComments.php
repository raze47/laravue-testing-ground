<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostsComments extends Model
{
    use HasFactory;

    protected $with = [
        'users'
    ];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Posts(){
        return $this->belongsTo('App\Models\Posts');
    }

}
