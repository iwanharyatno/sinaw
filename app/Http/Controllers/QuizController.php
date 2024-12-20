<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $search = "";
        $min_questions = 0;

        if (request('q')) {
            $search = request('q');
        }

        if (request('min_questions')) {
            $min_questions = request('min_questions');
        }

        $quizes = Quiz::query()
            ->withCount([
                'questions' => function (Builder $builder) use (&$query) {
                    $query = $builder;
                },
            ])
            ->setBindings($query->getBindings(), 'where')
            ->whereRaw("({$query->toSql()}) > ?", $min_questions)
            ->where('quiz_name', 'ILIKE', "%$search%")
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('kuis.index', compact('quizes'));
    }

    public function indexMine()
    {
        $user = User::find(Auth::user()->id);
        $quizes = $user->quizzes()->with('questions.answers')->orderBy('created_at', 'desc')->paginate(12);

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
            'created_by' => $user->id,
            'created_at' => Carbon::now()
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

        $quiz = Quiz::findOrFail($quizId);

        if ($request->file('header_image')) {
            if ($quiz->header_path) Storage::disk('google')->delete($quiz->header_path);

            $header_path = Storage::disk('google')->putFile('', $request->file('header_image'));
            $quiz->header_path = $header_path;
            $quiz->save();
        }

        // Update the quiz
        DB::table('quizzes')
            ->where('id', $quizId)
            ->update([
                'quiz_name' => $request->input('title'),
                'description' => $request->input('description') ?? ''
            ]);

        // Fetch existing data
        $existingQuestions = DB::table('questions')->where('quiz_id', $quizId)->get()->keyBy('id');
        $existingAnswers = DB::table('answers')->whereIn('question_id', $existingQuestions->keys())->get()->groupBy('question_id');

        // Prepare data for processing
        $newQuestions = [];
        $updatedQuestions = [];
        $deletedQuestionIds = $existingQuestions->keys()->toArray();

        $newAnswers = [];
        $updatedAnswers = [];
        $deletedAnswerIds = [];

        foreach ($request->input('questions') as $question) {
            if (isset($question['id'])) {
                // Existing question
                $deletedQuestionIds = array_diff($deletedQuestionIds, [$question['id']]);
                if ($existingQuestions[$question['id']]->content !== $question['text']) {
                    $updatedQuestions[] = [
                        'id' => $question['id'],
                        'content' => $question['text']
                    ];
                }

                // Process answers
                $currentAnswers = $existingAnswers->get($question['id'], collect())->keyBy('id');
                $deletedAnswerIds = array_merge(
                    $deletedAnswerIds,
                    array_diff($currentAnswers->keys()->toArray(), array_column($question['answers'], 'id'))
                );

                foreach ($question['answers'] as $answer) {
                    if (isset($answer['id'])) {
                        if (
                            $currentAnswers->has($answer['id']) &&
                            (
                                $currentAnswers[$answer['id']]->content !== $answer['text'] ||
                                $currentAnswers[$answer['id']]->is_correct != (isset($answer['is_correct']) ? $answer['is_correct'] == 'on' : false)
                            )
                        ) {
                            $updatedAnswers[] = [
                                'id' => $answer['id'],
                                'content' => $answer['text'],
                                'is_correct' => isset($answer['is_correct']) ? $answer['is_correct'] == 'on' : false
                            ];
                        }
                    } else {
                        $newAnswers[] = [
                            'question_id' => $question['id'],
                            'content' => $answer['text'],
                            'is_correct' => isset($answer['is_correct']) ? $answer['is_correct'] == 'on' : false
                        ];
                    }
                }
            } else {
                // New question
                $newQuestions[] = [
                    'quiz_id' => $quizId,
                    'content' => $question['text'],
                    'question_type' => $question['question_type']
                ];

                foreach ($question['answers'] as $answer) {
                    $newAnswers[] = [
                        'question_id' => null, // Will assign later after inserting questions
                        'content' => $answer['text'],
                        'is_correct' => isset($answer['is_correct']) ? $answer['is_correct'] == 'on' : false
                    ];
                }
            }
        }

        // Insert new questions and fetch IDs
        if (!empty($newQuestions)) {
            DB::table('questions')->insert($newQuestions);
            $lastQuestionId = DB::getPdo()->lastInsertId();
            $insertedQuestionIds = collect(range($lastQuestionId - (count($newQuestions) - 1), $lastQuestionId));

            foreach ($newQuestions as $index => $question) {
                foreach ($newAnswers as &$newAnswer) {
                    if ($newAnswer['question_id'] === null && isset($insertedQuestionIds[$index])) {
                        $newAnswer['question_id'] = $insertedQuestionIds[$index];
                    }
                }
            }
        }

        // Update questions in bulk
        if (!empty($updatedQuestions)) {
            foreach ($updatedQuestions as $question) {
                DB::table('questions')
                    ->where('id', $question['id'])
                    ->update(['content' => $question['content']]);
            }
        }

        // Delete removed questions
        if (!empty($deletedQuestionIds)) {
            DB::table('questions')->whereIn('id', $deletedQuestionIds)->delete();
        }

        // Insert new answers
        if (!empty($newAnswers)) {
            DB::table('answers')->insert($newAnswers);
        }

        // Update answers in bulk
        if (!empty($updatedAnswers)) {
            foreach ($updatedAnswers as $answer) {
                DB::table('answers')
                    ->where('id', $answer['id'])
                    ->update([
                        'content' => $answer['content'],
                        'is_correct' => isset($answer['is_correct']) ? $answer['is_correct'] == 'on' : false
                    ]);
            }
        }

        // Delete removed answers
        if (!empty($deletedAnswerIds)) {
            DB::table('answers')->whereIn('id', $deletedAnswerIds)->delete();
        }

        return response()->json(['message' => 'Quiz updated successfully.']);
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
