@extends('layouts.home')

@section('title', 'Nongkrong | SinaW')

@section('content')

<nav class="bg-gray-900 p-4 flex justify-between items-center text-white font-poppins">
  <!-- Logo -->
  <img src="{{ asset('asset/sinaw-logo.png') }}" alt="SinaW Logo" class="h-10">

  <!-- Tombol Menu untuk Mobile -->
  <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
  </button>

  <!-- Navigasi -->
  <ul class="hidden lg:flex gap-10 items-center">
    <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
    <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
    <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
    <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
  </ul>

  <!-- Tombol Aksi -->
  <div class="hidden lg:flex items-center gap-4">
    <a href="{{ route('nongkrong.create') }}"
       class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
      + Tuliskan
    </a>
    <a href="{{ route('nongkrong.mine') }}"
       class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
      Tulisan Saya
    </a>
    
    <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
    <img src="{{ auth()->user()->avatar ? '/image/' . auth()->user()->avatar : 'https://via.placeholder.com/64' }}"
    alt="Profile" class="w-10 h-10 rounded-full">
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 bg-gray-900 text-white w-64 h-full transform -translate-x-full transition-transform duration-300 z-50">
  <div class="p-4">
    <!-- Tombol Tutup -->
    <button id="sidebar-close" class="text-white focus:outline-none mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <!-- Menu Sidebar -->
    <ul class="p-4">
      <li><a href="{{ route('home.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Beranda</a></li>
      <li><a href="{{ route('aktivitas.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Aktivitas Saya</a></li>
      <li><a href="{{ route('nongkrong.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Nongkrong</a></li>
      <li><a href="{{ route('quiz.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Kuis</a></li>
    </ul>
    <hr class="my-4 border-gray-700">
    <a href="{{ route('nongkrong.create') }}"
       class="block bg-green-500 text-center text-white px-4 py-2 rounded-lg hover:bg-green-600 transition mb-4">
      + Tuliskan
    </a>
    <a href="{{ route('nongkrong.mine') }}"
       class="block bg-transparent text-center text-white px-4 py-2 rounded-lg hover:bg-green-500  transition">
      Tulisan Saya
    </a>
    <form method="POST" action="{{ route('home.logout') }}">
      @csrf
        <button
          class="block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 mt-4">
          Logout
        </button>
      </form>
  </div>
</div>


<div class="bg-gray-800 min-h-screen">
  <!-- Main Content -->
  <div class="p-8 grid gap-8 container mx-auto md:grid-cols-3">
    <!-- Left Column -->
    <div class="md:col-span-2">
      <!-- Input untuk Postingan -->
    <div class="bg-white text-black p-4 rounded-lg mb-6">
         <a href="{{ route('nongkrong.create') }}" class="w-full">
             <input type="text" placeholder="Bagaimana update hari ini?" class="w-full bg-slate-50 border-2 px-4 py-2 rounded-lg focus:outline-none" readonly />
                </a>
    </div>

      <!-- Tambahkan Postingan Lagi -->
      @foreach ($threads as $thread)
      <div class="bg-white p-6 rounded-lg mb-6">
        <div class="flex items-center gap-4 mb-4">
          <div class=" rounded-full bg-red-500">
          <img src="{{ auth()->user()->avatar ? '/image/' . auth()->user()->avatar : 'https://via.placeholder.com/64' }}"
          alt="Profile" class="w-10 h-10 rounded-full">
          </div>
          <div>
            <h3 class="font-bold text-black">{{ $thread->user->first_name . ' ' . $thread->user->last_name }}</h3>
            <p class="text-black text-sm">{{ Carbon\Carbon::parse($thread->created_at)->format('d M Y') }}</p>
          </div>
        </div>
        <h4 class="font-bold text-lg mb-2 text-black">
          {{ $thread->title }}
        </h4>
        <p class="text-black mb-4">
          {{ $thread->replies[0]->content }}
        </p>
        <div class="flex items-center gap-4">
          <button class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
            👍 8
          </button>
          <a href="{{ route('nongkrong.reply', $thread->id) }}" class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
            💬 {{ $thread->replies->count() - 1 }}
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Right Column -->
    <div class="w-full md:w-auto bg-white p-6 rounded-lg">
      <h4 class="font-bold text-lg mb-4 text-black">Eksplor Topik</h4>
      <ul class="space-y-2">
        <li><a href="#" class="block bg-white border-2 px-4 py-2 rounded-lg hover:bg-blue-300">Matematika</a></li>
        <li><a href="#" class="block bg-white border-2 px-4 py-2 rounded-lg hover:bg-blue-300">Sains</a></li>
        <li><a href="#" class="block bg-white border-2 px-4 py-2 rounded-lg hover:bg-blue-300">Teknologi</a></li>
        <li><a href="#" class="block bg-white border-2 px-4 py-2 rounded-lg hover:bg-blue-300">Komputer</a></li>
        <li><a href="#" class="block bg-white border-2 px-4 py-2 rounded-lg hover:bg-blue-300">Filosofi</a></li>
      </ul>
    </div>
  </div>
</div>

<script>
  // Elemen-elemen DOM
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const sidebarClose = document.getElementById('sidebar-close');

  // Event Listener untuk membuka sidebar
  menuToggle.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
  });

  // Event Listener untuk menutup sidebar
  sidebarClose.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
  });
</script>


@endsection
