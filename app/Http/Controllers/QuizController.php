<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(){
        return view('kuis.index');
    }

    public function show($id) {
        return view('kuis.show');
    }

    public function create() {
        return view('kuis.create');
    }
}
