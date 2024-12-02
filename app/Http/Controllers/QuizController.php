<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request) {
        dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions.*.text' => 'required|string',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.answers.*.is_correct' => 'nullable|boolean',
        ], [
            'title' => 'Judul kuis harus diisi',
            'questions.*.text' => 'Judul pertanyaan harus diisi',
            'questions.*.answers.*.text' => 'Opsi jawaban harus diisi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
    }
}
