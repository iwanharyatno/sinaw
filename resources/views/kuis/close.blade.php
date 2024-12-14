@extends('layouts.home')

@section('title', 'Kuis | SINAW')

@section('content')

<div class="bg-gray-800 text-white min-h-screen flex items-center justify-center">

    <div class="text-center p-8 bg-gray-900 font-poppins text-white rounded-lg shadow-lg max-w-md">
                <!-- Ilustrasi atau Icon -->
                <img src="{{ asset('/asset/close.png')}}" alt="Kuis Ditutup" class="w-20 mx-auto mb-4 animate-bounce" />
    
                <!-- Pesan Utama -->
                <h1 class="text-2xl font-bold mb-2">Oops! Kuis ini sudah ditutup.</h1>
                <p class="text-gray-400 mb-6">
                    Kuis yang Anda coba akses sudah tidak tersedia. Cobalah untuk bergabung di kuis lainnya atau hubungi penyelenggara kuis untuk informasi lebih lanjut.
                </p>
    
                <!-- Tombol Aksi -->
                <a href="{{ route('quiz.index') }}" 
                    class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    Cari Kuis Lainnya
                </a>
            </div>
</div>

@endsection