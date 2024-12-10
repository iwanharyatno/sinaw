@extends('layouts.base')

@section('title', 'Edit Quiz | SINAW')

@section('content')
    <div class="bg-gray-100">
        <form class="max-w-4xl mx-auto p-4" method="POST" action="{{ route('quiz.update', $quiz->id) }}" id="quizForm">
            @csrf
            <div class="flex items-center mb-4">
                <a href="{{ route('quiz.index-mine') }}"><i class="fas fa-arrow-left text-2xl"></i></a>
                <h1 class="text-2xl font-bold ml-2">Edit Quiz</h1>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <input type="text" placeholder="Tuliskan judul kuis" name="title" value="{{ $quiz->quiz_name }}"
                    class="w-full p-2 mb-4 border rounded-lg" required>
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center mb-4 rounded-lg">
                    <span class="text-gray-500">Ubah Cover</span>
                </div>
                <div class="space-y-4" id="questions-wrapper">
                    @foreach ($quiz->questions as $question)
                        <div class="p-4 bg-gray-100 rounded-lg question">
                            <input type="hidden" name="questions[{{ $loop->index + 1 }}][id]" value="{{ $question->id }}">
                            <input type="text" value="{{ $question->content }}" name="questions[{{ $loop->index + 1 }}][text]"
                                placeholder="Tuliskan soal..." class="w-full p-2 mb-2 border rounded-lg" required>
                            @error('questions.{{ $loop->index + 1 }}.text')
                                <span class="text-sm text-red-500 block">{{ $message }}</span>
                            @enderror
                            <div class="flex items-center mb-2">
                                <button class="flex items-center text-red-500">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah Media
                                </button>
                                <select class="ml-auto p-2 border rounded-lg" name="questions[{{ $loop->index + 1 }}][question_type]">
                                    <option value="MCQ">Pilihan Ganda</option>
                                    <option value="Short Answer">Isian Singkat</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                @foreach ($question->answers as $answer)
                                    <div class="flex items-center answer">
                                        <input type="hidden" name="questions[{{ $loop->parent->index + 1 }}][answers][{{ $loop->index }}][id]" value="{{ $answer->id }}">
                                        <input type="text" placeholder="Opsi"
                                            class="w-full p-2 border rounded-lg"
                                            value="{{ $answer->content }}"
                                            name="questions[{{ $loop->parent->index + 1 }}][answers][{{ $loop->index }}][text]" required>
                                        @error('questions.{{ $loop->parent->index + 1 }}.answers.{{ $loop->index }}.text')
                                            <span class="text-sm text-red-500 block">{{ $message }}</span>
                                        @enderror
                                        <input type="checkbox" class="ml-2"
                                            name="questions[{{ $loop->parent->index + 1 }}][answers][{{ $loop->index }}][is_correct]" {{ $answer->is_correct ? 'checked' : '' }}>
                                    </div>
                                @endforeach
                            </div>
                            <button class="w-full p-2 text-blue-500 border rounded-lg" type="button"
                                onclick="addAnswer(this, 1)">+ Tambah opsi jawaban</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="w-full p-2 mt-4 text-blue-500 border rounded-lg" onclick="addQuestion()">+
                    Tambah soal baru</button>
            </div>
            <div class="mt-4 p-4 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-bold mb-2">Pengaturan</h2>
                <div class="space-y-2">
                    <div>
                        <label for="topic" class="block mb-1">Topik</label>
                        <select id="topic" class="w-full p-2 border rounded-lg">
                            <option>Sains</option>
                        </select>
                    </div>
                    <div>
                        <label for="publish-date" class="block mb-1">Tanggal Publikasi</label>
                        <input type="date" id="publish-date" class="w-full p-2 border rounded-lg" value="2024-11-10">
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button class="px-4 py-2 text-white bg-blue-500 rounded-lg" name="action">Simpan</button>
                <button class="px-4 py-2 text-white bg-green-500 rounded-lg" name="action">Publikasi</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let questionIndex = Number("{{ $quiz->questions->count() + 1 }}");

        function addQuestion() {
            const questionHtml = `
        <div class="p-4 bg-gray-100 rounded-lg question">
            <input type="text" value="{{ old('questions.${questionIndex}.text') }}" name="questions[${questionIndex}][text]" placeholder="Tuliskan soal..." class="w-full p-2 mb-2 border rounded-lg" required>
            @error('questions.${questionIndex}.text')
                <span class="text-sm text-red-500 block">{{ $message }}</span>
            @enderror
            <div class="flex items-center mb-2">
                <button class="flex items-center text-red-500">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Media
                </button>
                <select class="ml-auto p-2 border rounded-lg" name="questions[${questionIndex}][question_type]">
                    <option value="MCQ">Pilihan Ganda</option>
                    <option value="Short Answer">Isian Singkat</option>
                </select>
            </div>
            <div class="space-y-2">
            </div>
            <button class="w-full p-2 text-blue-500 border rounded-lg" type="button" onclick="addAnswer(this, ${questionIndex})">+ Tambah opsi jawaban</button>
        </div>
        `;
            document.getElementById('questions-wrapper').insertAdjacentHTML('beforeend', questionHtml);
            questionIndex++;
        }

        function addAnswer(button, questionIndex) {
            const answersWrapper = button.previousElementSibling;
            const answerIndex = answersWrapper.querySelectorAll('.answer').length;
            const answerHtml = `
        <div class="flex items-center answer">
            <input type="text" placeholder="Opsi ${answerIndex+1}" class="w-full p-2 border rounded-lg" value="{{ old('questions.${questionIndex}.answers.${answerIndex}.text') }}" name="questions[${questionIndex}][answers][${answerIndex}][text]" required>
            @error('questions.${questionIndex}.answers.${answerIndex}.text')
                <span class="text-sm text-red-500 block">{{ $message }}</span>
            @enderror
            <input type="checkbox" class="ml-2" name="questions[${questionIndex}][answers][${answerIndex}][is_correct]">
        </div>`;
            answersWrapper.insertAdjacentHTML('beforeend', answerHtml);
        }

        document.getElementById('quizForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const questions = document.querySelectorAll('#questions-wrapper .question');
            let isValid = true;

            questions.forEach((question, index) => {
                const correctAnswerSelected = question.querySelector(`input[type="checkbox"]:checked`);
                if (!correctAnswerSelected) {
                    alert(`You must select a correct answer for Question ${index + 1}`);
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
            }

            const form = document.getElementById('quizForm');
            const formData = new FormData(form);

            fetch(form.getAttribute('action'), {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json(); // Asumsi server mengembalikan respons JSON
                    }
                    throw new Error('Terjadi kesalahan pada server.');
                })
                .then(data => {
                    // Tampilkan alert jika berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Kuis Berhasil Disimpan!',
                        text: 'Kuis Anda telah berhasil disimpan.',
                        confirmButtonText: 'Lihat Daftar Kuis',
                    }).then(() => {
                        window.location.href =
                        "{{ route('quiz.index') }}"; // Redirect ke halaman daftar kuis
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Membuat Kuis',
                        text: 'Silakan coba lagi nanti.',
                    });
                });
        });
    </script>
@endpush
