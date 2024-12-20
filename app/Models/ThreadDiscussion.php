<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadDiscussion extends Model
{
    protected $guarded = ['id'];

    public function replies() {
        return $this->hasMany(ThreadReply::class, 'thread_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'thread_likes', 'thread_id', 'user_id');
    }
}
