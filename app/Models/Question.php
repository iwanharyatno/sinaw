<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [
        'id'
    ];

    public function quiz() {
        return $this->hasOne(Quiz::class, 'quiz_id', 'id');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
