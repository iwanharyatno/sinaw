@extends('layouts.home')

@section('title', 'Join Quiz | SINAW')

@section('Home_content')

<div class="container flex items-center justify-center min-h-screen bg-gradient-to-r from-purple-500 via-blue-800-500 to-blue-950">
    <div class="text-center ">
        <!-- Header -->
        <h1 class="text-4xl font-bold text-white mb-6">SinaW</h1>

        <!-- Card -->
        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-xl p-6 shadow-lg w-[500px] h-[200px]">
        <div class="flex justify-between items-center">
                <!-- Profil -->
                <div class="text-left">
                    <p class="text-lg font-semibold text-white">Dominic Dinand</p>
                    <p class="flex items-center text-sm text-white">
                        <span class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></span>
                        700 poin
                    </p>
                </div>
                <!-- Avatar -->
                <div>
                    <img src="https://via.placeholder.com/60x60.png?text=🐴" alt="Avatar" class="w-14 h-14 rounded-full">
                </div>
            </div>

            <!-- Quiz Info -->
            <div class="mt-4 text-left">
                <p class="text-lg font-bold text-white">{{ $quiz->quiz_name }}</p>
                <p class="inline-block bg-pink-600 text-white text-sm font-bold px-3 py-1 rounded-full mt-2">
                {{ $quiz->questions->count() }} Soal
                </p>
                <p class="text-xs mt-2 text-white">{{ $quiz->user->first_name }}</p>
            </div>
        </div>

        <!-- Footer -->
        <p class="mt-6 text-lg italic text-white">Tunggu Host Memulai Quiz</p>
    </div>
</div>



@endsection