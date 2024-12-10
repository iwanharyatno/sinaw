@extends('layouts.base')



@section('content')

<body class="bg-gray-800 text-white min-h-screen">
  <!-- Navbar -->
  <nav class="bg-gray-900 p-4 flex justify-between items-center h-16">

  <div class="flex items-center gap-4 h-full flex-grow">
  <h1 class="text-2xl font-bold text-blue-400">SinaW</h1>
  <ul class="flex gap-10 justify-center items-center flex-grow">
    <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
    <li><a href="{{ route('kelas.index') }}" class="hover:text-blue-400">Kelas</a></li>
    <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
    <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
    <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
  </ul>
</div>

    @auth
      <div class="flex items-center gap-4">
        <a href="{{ route('quiz.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
          + Buat Kuis
        </a>
        <a href="{{ route('quiz.index-mine') }}" class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
          Kuis Saya
        </a>
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-white font-bold">{{ auth()->user()->first_name[0] }}</span> <!-- Ganti dengan gambar profil -->
        </div>
      </div>
    @endauth
  </nav>

  @yield ('Home_content')
@endsection