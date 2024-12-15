@extends('layouts.home')

@section('title', 'Aktivitas | SinaW')

@section('Home_content')
    <main class="p-8 container mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-white font-poppins">Aktivitas Saya</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($attempts as $attempt)
                <div class="bg-blue-700 p-6 text-white rounded-lg">
                    <div class="bg-white text-black text-xs px-2 py-1 rounded-full inline-block mb-2">{{ $attempt->quiz->questions->count() }} Soal</div>
                    <h2 class="text-xl font-semibold mb-2">{{ $attempt->quiz->quiz_name }}</h2>
                    <p class="text-sm mb-4">By : {{ $attempt->quiz->user->first_name . " " . $attempt->quiz->user->last_name }}</p>
                    <div class="bg-green-500 text-xs px-2 py-1 rounded-full inline-block">Nilai : <strong>{{ round($attempt->score) }}/100</strong></div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
