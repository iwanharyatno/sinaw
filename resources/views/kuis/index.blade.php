@extends('layouts.home')

@section('title', 'Kuis | SINAW')

@section('Home_content')


    <!-- Konten -->
    <div class="p-6 text-white">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4 text-white">
            <h2 class="text-xl font-semibold">Cari atau buat kuis</h2>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <form action="{{ route('quiz.index') }}"
                class="flex flex-col md:flex-row flex-grow md:items-center gap-4 w-full md:w-auto">
                <select name="min_questions"
                    class="bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:ring focus:ring-blue-500">
                    <option value="0" {{ request('min_questions') == 0 ? 'selected' : '' }}>Semua jumlah pertanyaan</option>
                    <option value="5" {{ request('min_questions') == 5 ? 'selected' : '' }}>Total Pertanyaan 5 atau lebih</option>
                    <option value="10" {{ request('min_questions') == 10 ? 'selected' : '' }}>Total Pertanyaan 10 atau lebih</option>
                    <option value="15" {{ request('min_questions') == 15 ? 'selected' : '' }}>Total Pertanyaan 15 atau lebih</option>
                    <option value="20" {{ request('min_questions') == 20 ? 'selected' : '' }}>Total Pertanyaan 20 atau lebih</option>
                    <option value="25" {{ request('min_questions') == 25 ? 'selected' : '' }}>Total Pertanyaan 25 atau lebih</option>
                </select>
                <input type="text" placeholder="Cari Kuis Disini..." name="q" value="{{ request('q') }}"
                    class="flex-grow bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring focus:ring-blue-500" />
                <button class="bg-gray-700 px-4 py-2 rounded-lg text-white">Cari</button>
            </form>
            <a href="{{ route('quiz.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</a>
        </div>

        <!-- Grid Kartu Kuis -->
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($quizes as $quiz)
                @php
                    $difficulty = 'Mudah';

                    if ($quiz->difficulty == 'medium') {
                        $difficulty = 'Medium';
                    } elseif ($quiz->difficulty == 'hard') {
                        $difficulty = 'Sulit';
                    }
                @endphp
                <!-- Kartu Kuis -->
                <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
                    <a href="{{ route('quiz.show', $quiz->id) }}">
                        <img src="/image/{{ $quiz->header_path }}" alt="Thumbnail"
                            class="w-full h-24 object-cover rounded-lg mb-4 bg-gray-200" />
                        <h3 class="text-lg font-bold">{{ $quiz->quiz_name }}</h3>
                        <p class="text-sm text-white">{{ $difficulty }} • {{ $quiz->questions_count }} Soal</p>
                        <p class="text-sm text-white mb-4">
                            {{ Carbon\Carbon::parse($quiz->created_at)->locale('id')->diffForHumans() }}</p>
                    </a>
                    <a href="{{ route('quiz.join', $quiz->id) }}"
                        class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-green-500 transition inline-block text-center">Mulai
                        Langsung</a>
                </div>
            @endforeach
        </div>

        <div class="mt-8 bg-white pl-4 rounded-lg">
            {!! $quizes->links() !!}
        </div>
    </div>

@endsection
