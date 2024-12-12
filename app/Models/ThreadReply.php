<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadReply extends Model
{
    protected $guarded = ['id'];

    public function thread() {
        return $this->belongsTo(ThreadDiscussion::class, 'thread_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
