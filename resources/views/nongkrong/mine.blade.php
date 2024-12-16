@extends('layouts.base')

@section('title', 'Riwayat Tulisan - ' . $user->first_name)

@section('content')
    <nav class="bg-gray-900 p-4 flex justify-between items-center text-white font-poppins">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-white">Sina<span class="text-purple-400">W</span></h1>

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
    <div id="sidebar"
        class="fixed top-0 left-0 bg-gray-900 text-white w-64 h-full transform -translate-x-full transition-transform duration-300 z-50">
        <div class="p-4">
            <!-- Tombol Tutup -->
            <button id="sidebar-close" class="text-white focus:outline-none mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Menu Sidebar -->
            <ul class="p-4">
                <li><a href="{{ route('home.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Beranda</a>
                </li>
                <li><a href="{{ route('aktivitas.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Aktivitas
                        Saya</a></li>
                <li><a href="{{ route('nongkrong.index') }}"
                        class="block py-2 px-4 hover:bg-gray-700 rounded-md">Nongkrong</a></li>
                <li><a href="{{ route('quiz.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Kuis</a></li>
            </ul>
            <hr class="my-4 border-gray-700">
            <a href="{{ route('nongkrong.create') }}"
                class="block bg-green-500 text-center text-white px-4 py-2 rounded-lg hover:bg-green-600 transition mb-4">
                + Tuliskan
            </a>
            <a href="{{ route('nongkrong.mine') }}"
                class="block bg-transparent text-center text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
                Tulisan Saya
            </a>
            <form method="POST" action="{{ route('home.logout') }}">
                @csrf
                <button class="block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 mt-4">
                    Logout
                </button>
            </form>
        </div>
    </div>


    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Riwayat Tulisan oleh {{ $user->first_name }}</h2>

        @if ($threads->isEmpty())
            <p class="text-gray-500">Belum ada tulisan yang dibuat oleh {{ $user->first_name }}.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($threads as $thread)
                    <div class="bg-gray-100 shadow-md rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $thread->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ \Str::limit($thread->replies->first()->content ?? 'Tidak ada konten', 100) }}</p>
                        <p class="text-xs text-gray-500 mb-4">
                            Dipublikasikan pada {{ $thread->created_at->format('d M Y H:i') }}
                        </p>
                        <div class="flex gap-4">
                            <a href="{{ route('nongkrong.reply', $thread->id) }}"
                                class="text-blue-500 hover:underline">Lihat</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 bg-white pl-4 rounded-full">
                {{ $threads->links() }}
            </div>
        @endif
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
