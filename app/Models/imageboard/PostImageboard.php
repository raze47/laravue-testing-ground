<?php

namespace App\Models\imageboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImageboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'post',
        'post_id',
        'reply_id',
        'file_path',
    ];

    public function replyImageboard(){
        return $this->hasMany('App\Models\imageboard\ReplyImageboard', 'post_id');
    }
}
