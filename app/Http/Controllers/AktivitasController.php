<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    public function index() {
        $user = User::find(Auth::user()->id);
        $attempts = $user->quizAttempts()->with('quiz.questions', 'quiz.user')->orderBy('created_at', 'desc')->get();
        return view('aktivitas.index', compact('attempts'));
    }

}
