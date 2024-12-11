<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index() {
        $attempts = QuizAttempt::with('quiz.questions', 'quiz.user')->get();
        return view('aktivitas.index', compact('attempts'));
    }

}
