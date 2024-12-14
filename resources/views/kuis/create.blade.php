@extends('layouts.base')

@section('title', 'Tambah Quiz Baru | SINAW')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <form class="max-w-4xl mx-auto p-4" method="POST" action="{{ route('quiz.store') }}" id="quizForm">
            @csrf
            <div class="flex items-center mb-4">
                <a href="/kuis"><i class="fas fa-arrow-left text-2xl"></i></a>
                <h1 class="text-2xl font-bold ml-2">Buat Kuis Baru</h1>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <input type="text" placeholder="Tuliskan judul kuis" name="title"
                    class="w-full p-2 mb-4 border rounded-lg" required>
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center mb-4 rounded-lg bg-contain bg-no-repeat bg-center"
                    id="header_image">
                    <span class="text-gray-500">Ubah Cover</span>
                    <input type="file" name="header_image" id="header_image_file" style="display: none">
                </div>
                <div class="space-y-4" id="questions-wrapper">

                </div>
                <button type="button" class="w-full p-2 mt-4 text-blue-500 border rounded-lg" onclick="addQuestion()">+
                    Tambah soal baru</button>
            </div>
            <div>
                <progress class="w-full mt-4" max="100" value="0" id="uploadProgress"
                    style="display: none"></progress>
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button id="btnSimpan" class="px-4 py-2 text-white bg-blue-500 rounded-lg disabled:bg-blue-200"
                    name="action">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let questionIndex = 1;
        const btnSimpan = document.getElementById('btnSimpan');
        const fileUpload = document.getElementById('header_image_file');
        const progressElement = document.getElementById('uploadProgress');

        function addQuestion() {
            const questionHtml = `
        <div class="p-4 bg-gray-100 rounded-lg question" id="question${questionIndex}">
            <button type="button" onclick="deleteQuestion(${questionIndex})" class="text-red-500 cursor-pointer mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </button>
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
        <div class="flex items-center answer" id="answer${questionIndex}a${answerIndex}">
            <input type="text" placeholder="Opsi ${answerIndex+1}" class="w-full p-2 border rounded-lg" value="{{ old('questions.${questionIndex}.answers.${answerIndex}.text') }}" name="questions[${questionIndex}][answers][${answerIndex}][text]" required>
            @error('questions.${questionIndex}.answers.${answerIndex}.text')
                <span class="text-sm text-red-500 block">{{ $message }}</span>
            @enderror
            <input type="checkbox" class="ml-2" name="questions[${questionIndex}][answers][${answerIndex}][is_correct]">
            <button type="button" onclick="deleteAnswer(${questionIndex}, ${answerIndex})" class="text-red-500 cursor-pointer mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </button>
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
                return;
            }

            const form = document.getElementById('quizForm');
            const formData = new FormData(form);

            btnSimpan.setAttribute('disabled', 'true');
            progressElement.style.display = "block";
            btnSimpan.innerText = "Loading...";

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.getAttribute('action'), true);

            // Update progress bar during upload
            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentComplete = (event.loaded / event.total) * 100;
                    progressElement.value = percentComplete; // Set progress value
                    progressElement.textContent = `${Math.round(percentComplete)}%`; // Update text (optional)
                }
            };

            // Handle successful completion of the request
            xhr.onload = function() {
                const progressElement = document.getElementById('uploadProgress');
                progressElement.value = 100; // Set progress to 100% on completion

                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const data = JSON.parse(xhr.responseText); // Parse JSON response
                        // Show success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Kuis Berhasil Dibuat!',
                            text: 'Kuis Anda telah berhasil disimpan.',
                            confirmButtonText: 'Lihat Daftar Kuis',
                        }).then(() => {
                            window.location.href =
                                "{{ route('quiz.index') }}"; // Redirect to the quiz list page
                        });
                    } catch (error) {
                        console.error('Parsing error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Membuat Kuis',
                            text: 'Respons dari server tidak valid.',
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Membuat Kuis',
                        text: 'Silakan coba lagi nanti.',
                    });
                }
            };

            // Handle network errors
            xhr.onerror = function() {
                console.error('Request error');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Membuat Kuis',
                    text: 'Silakan coba lagi nanti.',
                });
            };

            // Clean up after the request
            xhr.onloadend = function() {
                btnSimpan.removeAttribute('disabled');
                btnSimpan.innerText = "Simpan";
                progressElement.style.display = 'none';
            };

            // Send the form data
            xhr.send(formData);

        });

        function deleteQuestion(questionIndex) {
            document.getElementById('question' + questionIndex).remove();
        }

        function deleteAnswer(questionIndex, answerIndex) {
            document.getElementById('answer' + questionIndex + 'a' + answerIndex).remove();
        }

        document.getElementById('header_image').addEventListener('click', function() {
            fileUpload.click();
        });

        fileUpload.addEventListener('change', function() {
            document.getElementById('header_image').style.backgroundImage = "url(" + URL.createObjectURL(this.files[
                0]) + ")";
        });
    </script>
@endpush
