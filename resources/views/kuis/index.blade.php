@extends('layouts.home')

@section('title', 'Kuis | SINAW')

@section('Home_content')

    <body class="bg-gray-800 text-white min-h-screen">
        <!-- Navbar -->


        <!-- Konten -->
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Cari atau buat kuis</h2>
            </div>

            <!-- Filter dan Pencarian -->
            <div class="flex items-center gap-4 mb-6">
                <select
                    class="bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:ring focus:ring-blue-500">
                    <option>Total Pertanyaan 5 atau lebih</option>
                </select>
                <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Tambah Filter</button>
                <input type="text" placeholder="Cari Kuis Disini..."
                    class="flex-grow bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring focus:ring-blue-500" />
                <button class="bg-gray-700 px-4 py-2 rounded-lg text-white">Terbaru</button>
            </div>

            <!-- Grid Kartu Kuis -->
            <div class="grid grid-cols-4 gap-6">
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
                            <img src="https://via.placeholder.com/150" alt="Thumbnail"
                                class="w-full h-24 object-cover rounded-lg mb-4" />
                            <h3 class="text-lg font-bold">{{ $quiz->quiz_name }}</h3>
                            <p class="text-sm text-gray-700">{{ $difficulty }} • {{ $quiz->questions->count() }} Soal</p>
                            <p class="text-sm text-gray-700 mb-4">
                                {{ Carbon\Carbon::parse($quiz->created_at)->locale('id')->diffForHumans() }}</p>
                        </a>
                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Mulai
                            Langsung</button>
                    </div>
                    <!-- Salin kartu di atas untuk mengisi grid -->
                @endforeach
            </div>
        </div>

    @endsection
