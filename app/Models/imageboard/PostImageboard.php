<?php

namespace App\Models\imageboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImageboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'post',
        'thread_file',
    ];

    public function replyImageboard(){
        return $this->hasMany('App\Models\imageboard\ReplyImageboard', 'post_id');
    }
}
