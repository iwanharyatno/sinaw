<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gauth_id',
        'gauth_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class, 'created_by', 'id');
    }

    public function quizAttempts() {
        return $this->hasMany(QuizAttempt::class, 'user_id', 'id');
    }

    public function threads() {
        return $this->hasMany(ThreadDiscussion::class, 'user_id', 'id');
    }

    public function threadLikes() {
        return $this->belongsToMany(ThreadDiscussion::class, 'thread_likes', 'user_id', 'thread_id');
    }
}
