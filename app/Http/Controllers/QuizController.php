<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $query = "";

        if (request('q')) {
            $query = request('q');
        }

        $quizes = Quiz::with('questions')->where('is_public', 'true')->where('quiz_name', 'ILIKE', "%$query%")->orderBy('created_at', 'desc')->get();

        return view('kuis.index', compact('quizes', 'query'));
    }

    public function indexMine()
    {
        $user = User::find(Auth::user()->id);
        $quizes = $user->quizzes()->with('questions.answers')->orderBy('created_at', 'desc')->get();

        return view('kuis.mine', compact('quizes'));
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->find($id);

        if (!$quiz->is_public) {
            return view('kuis.close', compact('quiz'));
        }

        return view('kuis.show', compact('quiz'));
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions.answers')->find($id);
        return view('kuis.edit', compact('quiz'));
    }

    public function create()
    {
        return view('kuis.create');
    }

    public function join($id)
    {
        $quiz = Quiz::with('questions')->find($id);

        if (!$quiz->is_public) {
            return view('kuis.close', compact('quiz'));
        }

        return view('kuis.join', compact('quiz'));
    }

    public function close()
    {
        return view('kuis.close');
    }
    public function joinUsingCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        return redirect()->route('quiz.join', $request->code);
    }

    public function store(Request $request)
    {
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

        // Create Questions and Answers
        $user = User::find(Auth::user()->id);

        $header_path = null;

        if ($request->file('header_image')) {
            $header_path = Storage::disk('google')->putFile('', $request->file('header_image'));
        }

        $quizId = $user->quizzes()->insertGetId([
            'quiz_name' => $data['title'],
            'description' => $data['description'] ?? "",
            'difficulty' => 'easy',
            'header_path' => $header_path,
            'created_by' => $user->id
        ]);

        // Prepare questions for bulk insertion
        $questions = collect($request->input('questions'))->map(function ($question) use ($quizId) {
            return [
                'quiz_id' => $quizId,
                'content' => $question['text'],
                'question_type' => $question['question_type']
            ];
        });

        // Insert questions and get their IDs
        DB::table('questions')->insert($questions->toArray());
        $lastQuestionId = DB::getPdo()->lastInsertId();
        $questionIds = collect(range($lastQuestionId - $questions->count(), $lastQuestionId));

        // Prepare answers for bulk insertion
        $answers = [];
        foreach ($request->input('questions') as $index => $question) {
            foreach ($question['answers'] as $answer) {
                $answers[] = [
                    'question_id' => $questionIds[$index],
                    'content' => $answer['text'],
                    'is_correct' => isset($answer['is_correct'])
                ];
            }
        }

        // Insert answers in bulk
        DB::table('answers')->insert($answers);

        return response()->json(['message' => 'Quiz created successfully.']);
    }

    public function update(Request $request, $quizId)
    {
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
        // Update the quiz
        DB::table('quizzes')
            ->where('id', $quizId)
            ->update([
                'quiz_name' => $request->input('title'),
                'description' => $request->input('description') ?? ''
            ]);

        $existingQuestionIds = DB::table('questions')->where('quiz_id', $quizId)->pluck('id')->toArray();
        $updatedQuestionIds = collect($request->input('questions'))->pluck('id')->filter()->toArray();

        // Delete removed questions
        $questionsToDelete = array_diff($existingQuestionIds, $updatedQuestionIds);
        DB::table('questions')->whereIn('id', $questionsToDelete)->delete();

        // Update or insert questions
        foreach ($request->input('questions') as $question) {
            if (isset($question['id'])) {
                // Update existing question
                DB::table('questions')
                    ->where('id', $question['id'])
                    ->update([
                        'content' => $question['text'],
                        'question_type' => $question['question_type']
                    ]);
            } else {
                // Insert new question
                $newQuestionId = DB::table('questions')->insertGetId([
                    'quiz_id' => $quizId,
                    'content' => $question['text'],
                    'question_type' => $question['question_type']
                ]);

                $question['id'] = $newQuestionId; // Update local data for further processing
            }

            // Process answers
            $existingAnswerIds = DB::table('answers')->where('question_id', $question['id'])->pluck('id')->toArray();
            $updatedAnswerIds = collect($question['answers'])->pluck('id')->filter()->toArray();

            // Delete removed answers
            $answersToDelete = array_diff($existingAnswerIds, $updatedAnswerIds);
            DB::table('answers')->whereIn('id', $answersToDelete)->delete();

            foreach ($question['answers'] as $answer) {
                if (isset($answer['id'])) {
                    // Update existing answer
                    DB::table('answers')
                        ->where('id', $answer['id'])
                        ->update([
                            'content' => $answer['text'],
                            'is_correct' => isset($answer['is_correct'])
                        ]);
                } else {
                    // Insert new answer
                    DB::table('answers')->insert([
                        'question_id' => $question['id'],
                        'content' => $answer['text'],
                        'is_correct' => isset($answer['is_correct'])
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function play($id)
    {
        $quiz = Quiz::with('questions.answers')->find($id);

        if (!$quiz->is_public) {
            return view('kuis.close', compact('quiz'));
        }

        return view('kuis.play', compact('quiz'));
    }

    public function attempt(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|numeric',
            'points' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $quiz = Quiz::find($id);

        if (!$quiz->is_public) {
            return view('kuis.close', compact('quiz'));
        }

        $attempt = $quiz->attempts()->create([
            'user_id' => Auth::user()->id,
            'score' => $data['score']
        ]);
        $user = User::find(Auth::user()->id);
        $user->points += intval($data['points']);
        $user->save();

        return response([
            'success' => true,
            'attempt' => $attempt
        ]);
    }

    public function delete($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();

        if ($quiz->header_path) Storage::disk('google')->delete($quiz->header_path);

        return back();
    }

    public function changeVisibility(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        $quiz->is_public = request('is_public');

        $quiz->save();

        return redirect()->route('quiz.index-mine');
    }
}
