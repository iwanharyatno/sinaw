@extends('layouts.base')

@section('title', 'Main kuis')

@section('content')
    <div class="bg-gray-800 min-h-screen w-full flex items-center justify-center p-4">
        <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-6" id="screenPlay">
            <div class="flex justify-between items-center mb-4">
                <div class="bg-gray-700 text-white p-2 rounded-full "><span
                        id="currentQuestionNumber">1</span>/{{ $quiz->questions->count() }}</div>
                <div class="bg-pink-500 text-white p-2 rounded-full"><span id="points">0</span> Points</div>
            </div>
            <div class="w-full mb-4 bg-gray-200 rounded-full">
                <div id="questionTimeProgress" class="h-1 bg-blue-500 rounded-full w-1/2"></div>
            </div>
            @foreach ($quiz->questions as $question)
                <div class="question hidden" id="questionNumber{{ $loop->index + 1 }}">
                    <h2 class="text-center text-xl font-bold mb-6">{{ $question->content }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($question->answers as $answer)
                            <div data-correct="{{ $answer->is_correct }}"
                                class="answer bg-white p-4 rounded-lg border border-gray-300 text-gray-800 text-center cursor-pointer hover:bg-gray-200">
                                <p>{{ $answer->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center text-white hidden opacity-0" style="animation-fill-mode: forwards" id="screenDone">
            <p class="text-3xl font-bold mb-2">Selesai!</p>
            <p>Memproses hasilmu...</p>
            <div
                class="animate-spin w-8 h-8 border-4 mx-auto mt-4 rounded-full border-t-gray-200 border-b-blue-500 border-l-blue-500 border-r-blue-500">
            </div>
        </div>

        <div class="text-center text-white hidden opacity-0" style="animation-fill-mode: forwards" id="screenResult">
            <p class="text-3xl font-bold mb-2">Kerja Bagus!</p>
            <p>Nilai: <span id="nilaiAkhir">0</span></p>
            <p>Poin: <span id="poinAkhir">0</span></p>
            <a href="{{ route('quiz.index') }}"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition inline-block text-center mt-8">Ke Daftar Kuis</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', startPlaying);

        const questions = document.querySelectorAll('.question');
        const totalQuestion = Number('{{ $quiz->questions->count() }}')
        let currentQuestionNumber = 0;
        let lastQuestionNumber = 0;

        let timerTimeoutId;

        let playing = true;

        let currentSecond = 30;
        let currentTotalSeconds = 30;
        let points = 0;

        const answers = [];

        function startPlaying() {
            openQuestion(1);

            document.querySelectorAll('.answer').forEach(element => {
                element.addEventListener('click', function() {
                    if (answers[currentQuestionNumber - 1] == undefined) {
                        const isCorrect = this.getAttribute('data-correct');
                        this.classList.remove(...('bg-white border-gray-300 text-gray-800 hover:bg-gray-200'
                            .split(' ')))

                        if (isCorrect) {
                            this.classList.add(...(
                                'bg-green-600 text-white border-green-600 border hover:bg-green-700'
                                .split(' ')));

                            points += Math.max(Math.ceil(currentSecond * 100 / currentTotalSeconds), 20);
                        } else {
                            this.classList.add(...(
                                'bg-red-600 text-white border-red-600 border hover:bg-red-700'
                                .split(
                                    ' ')));
                            const correctAnswer = document.getElementById('questionNumber' +
                                currentQuestionNumber).querySelector(
                                '[data-correct="1"]');
                            correctAnswer.classList.remove(...(
                                'bg-white border-gray-300 text-gray-800 hover:bg-gray-200'
                                .split(' ')));
                            correctAnswer.classList.add(...(
                                'bg-green-600 text-white border-green-600 border hover:bg-green-700'
                                .split(' ')));;
                        }

                        answers[currentQuestionNumber - 1] = !!isCorrect;
                    }

                    setTimeout(nextQuestion, 2000);
                });
            });
        }

        function nextQuestion() {
            document.getElementById('points').innerText = points;

            if (currentQuestionNumber >= totalQuestion) {
                finishQuiz();
                return;
            }

            if (timerTimeoutId) clearTimeout(timerTimeoutId);
            openQuestion(currentQuestionNumber + 1);
        }

        function openQuestion(qNumber) {
            document.getElementById('currentQuestionNumber').innerText = qNumber;

            lastQuestionNumber = currentQuestionNumber;
            currentQuestionNumber = qNumber;

            const question = document.querySelector('#questionNumber' + qNumber);
            question.classList.remove('hidden');

            if (lastQuestionNumber > 0) {
                document.querySelector('#questionNumber' + lastQuestionNumber).classList.add('hidden');
            }

            restartTimer(30);
        }

        function restartTimer(timeSeconds) {
            const timerProgress = document.getElementById('questionTimeProgress');
            currentSecond = timeSeconds;
            currentTotalSeconds = timeSeconds;

            const handleUpdate = () => {
                timerProgress.style.width = currentSecond * 100 / currentTotalSeconds + '%';
                currentSecond -= 0.05;
                if (currentSecond > 0) timerTimeoutId = setTimeout(handleUpdate, 50);
            };

            timerTimeoutId = setTimeout(handleUpdate, 50);
        }

        function finishQuiz() {
            clearTimeout(timerTimeoutId);

            document.getElementById('screenDone').classList.add('animate-fade-in');
            document.getElementById('screenDone').classList.remove('hidden');
            document.getElementById('screenPlay').classList.add('hidden');

            postAttempt();
        }

        function postAttempt() {
            const corrects = answers.filter(d => d).length;
            const score = corrects * 100 / totalQuestion;
            const data = {
                score,
                points: points,
                '_token': '{{ csrf_token() }}'
            };

            fetch("{{ route('quiz.attempt', $quiz->id) }}", {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-type': 'application/json'
                    }
                }).then(res => {
                    if (res.ok) return res.json();
                    console.error(res);
                    return res.text();
                })
                .then(res => {
                    if (res.success) {
                        document.getElementById('screenResult').classList.add('animate-fade-in');
                        document.getElementById('screenResult').classList.remove('hidden');
                        document.getElementById('screenDone').classList.add('hidden');

                        document.getElementById('poinAkhir').innerText = points;
                        document.getElementById('nilaiAkhir').innerText = score;
                    } else {
                        console.error(res);
                    }
                }).catch(console.error);
        }
    </script>
@endpush
