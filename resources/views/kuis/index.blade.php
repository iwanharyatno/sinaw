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
                <select
                    class="bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:ring focus:ring-blue-500">
                    <option>Total Pertanyaan 5 atau lebih</option>
                </select>
                <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Tambah Filter</button>
                <form action="{{ route('quiz.index') }}" class="flex flex-grow items-center gap-4 w-full md:w-auto">
                    <input type="text" placeholder="Cari Kuis Disini..." name="q" value="{{ $query }}"
                        class="flex-grow bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring focus:ring-blue-500" />
                    <button class="bg-gray-700 px-4 py-2 rounded-lg text-white">Cari</button>
                </form>
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
                    <div class="bg-yellow-400 text-gray-900 p-4 rounded-lg shadow-md">
                        <a href="{{ route('quiz.show', $quiz->id) }}">
                            <img src="/image/{{ $quiz->header_path }}" alt="Thumbnail"
                                class="w-full h-24 object-cover rounded-lg mb-4 bg-gray-200" />
                            <h3 class="text-lg font-bold">{{ $quiz->quiz_name }}</h3>
                            <p class="text-sm text-gray-700">{{ $difficulty }} • {{ $quiz->questions->count() }} Soal</p>
                            <p class="text-sm text-gray-700 mb-4">
                                {{ Carbon\Carbon::parse($quiz->created_at)->locale('id')->diffForHumans() }}</p>
                        </a>
                        <a href="{{ route('quiz.join', $quiz->id) }}"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition inline-block text-center">Mulai
                            Langsung</a>
                    </div>
                @endforeach
            </div>
        </div>

    @endsection
