<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index(){
        $quizes = Quiz::with('questions')->orderBy('created_at', 'desc')->get();

        return view('kuis.index', compact('quizes'));
    }

    public function indexMine(){
        $user = User::find(Auth::user()->id);
        $quizes = $user->quizzes()->with('questions.answers')->orderBy('created_at', 'desc')->get();

        return view('kuis.mine', compact('quizes'));
    }

    public function show($id) {
        $quiz = Quiz::with('questions')->find($id);
        return view('kuis.show', compact('quiz'));
    }

    public function edit($id) {
        $quiz = Quiz::with('questions.answers')->find($id);
        return view('kuis.edit', compact('quiz'));
    }

    public function create() {
        return view('kuis.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions.*.text' => 'required|string',
            'questions.*.question_type' => 'required|string',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.answers.*.is_correct' => 'nullable',
        ], [
            'title' => 'Judul kuis harus diisi',
            'questions.*.text' => 'Judul pertanyaan harus diisi',
            'questions.*.answers.*.text' => 'Opsi jawaban harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = $validator->validated();

        $user = User::find(Auth::user()->id);

        $quiz = $user->quizzes()->create([
            'quiz_name' => $data['title'],
            'description' => $data['description'] ?? "",
            'difficulty' => 'easy'
        ]);
    
        // Create Questions and Answers
        foreach ($data['questions'] as $questionData) {
            $question = $quiz->questions()->create([
                'content' => $questionData['text'],
                'question_type' => $questionData['question_type']
            ]);
            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'] ?? 0,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $quiz 
        ]);
    }

    public function update(Request $request, $quizId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'questions' => 'array',
            'questions.*.id' => 'nullable|exists:questions,id',
            'questions.*.text' => 'required|string',
            'questions.*.question_type' => 'required|string',
            'questions.*.answers' => 'array',
            'questions.*.answers.*.id' => 'nullable|exists:answers,id',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.answers.*.is_correct' => 'nullable',
        ], [
            'title' => 'Judul kuis harus diisi',
            'questions.*.text' => 'Judul pertanyaan harus diisi',
            'questions.*.answers.*.text' => 'Opsi jawaban harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = $validator->validated();

        DB::transaction(function () use ($data, $quizId) {
            // Update the quiz title
            $quiz = Quiz::findOrFail($quizId);
            $quiz->update(['quiz_name' => $data['title']]);
    
            // Keep track of updated IDs
            $updatedQuestionIds = [];
            $updatedAnswerIds = [];
    
            foreach ($data['questions'] as $questionData) {
                // Update or create question
                $question = $quiz->questions()->updateOrCreate(
                    ['id' => $questionData['id'] ?? null],
                    [
                        'content' => $questionData['text'],
                        'question_type' => $questionData['question_type'],
                    ]
                );
    
                $updatedQuestionIds[] = $question->id;
    
                foreach ($questionData['answers'] as $answerData) {
                    // Update or create answer
                    $answer = $question->answers()->updateOrCreate(
                        ['id' => $answerData['id'] ?? null],
                        [
                            'content' => $answerData['text'],
                            'is_correct' => $answerData['is_correct'] ?? false,
                        ]
                    );
    
                    $updatedAnswerIds[] = $answer->id;
                }
    
                // Delete removed answers
                $question->answers()
                    ->whereNotIn('id', $updatedAnswerIds)
                    ->delete();
            }
    
            // Delete removed questions
            $quiz->questions()
                ->whereNotIn('id', $updatedQuestionIds)
                ->delete();
        });

        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function delete($id) {
        $quiz = Quiz::find($id);
        $quiz->delete();

        return back();
    }
}
