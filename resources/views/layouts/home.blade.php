@extends('layouts.base')

@section('content')

<body class="bg-gray-800 font-poppins min-h-screen">
  <!-- Navbar -->
  <nav class="bg-gray-900 p-4 flex flex-wrap text-white justify-between items-center h-auto lg:h-16">

    <!-- Logo dan Navigasi -->
    <div class="flex items-center justify-between w-full lg:w-auto">
      <h1 class="text-2xl font-bold text-white">Sina<span class="text-purple-400">W</span></h1>
      <!-- Tombol Menu untuk Mobile -->
      <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>

    <!-- Daftar Navigasi -->
    <ul id="nav-menu" class="hidden lg:flex flex-col lg:flex-row gap-4 lg:gap-10 mt-4 lg:mt-0 w-full lg:w-auto">
      <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
      <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
      <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
      <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
    </ul>

    @auth
      <!-- Profil dan Tombol -->
      <div class="flex items-center gap-4 mt-4 lg:mt-0">
        <a href="{{ route('quiz.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
          + Buat Kuis
        </a>
        <a href="{{ route('quiz.index-mine') }}" class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
          Kuis Saya
        </a>
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-white font-bold">{{ auth()->user()->first_name[0] }}</span>
        </div>
      </div>
    @endauth

  </nav>

  @yield ('Home_content')

  <script>
    // Script untuk toggle menu pada mobile
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');

    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('hidden');
    });
  </script>
@endsection
