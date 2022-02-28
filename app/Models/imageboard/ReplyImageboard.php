<?php

namespace App\Models\imageboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyImageboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'post',
        'post_id',
        'reply_id',
        'reply_reply_id',
        'file_path',
    ];

    public function postImageboard()
    {
        return $this->belongsTo('App\Models\imageboard\PostImageboard', 'post_id');
    }

}
