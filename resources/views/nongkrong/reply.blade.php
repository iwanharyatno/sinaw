@extends('layouts.base')

@section('title', 'Tambah Update Baru | SINAW')

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
        @auth
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
        @endauth
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
                class="block bg-transparent text-center text-white px-4 py-2 rounded-lg hover:bg-green-500  transition">
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

    <div class=" min-h-screen ">

        <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-4 ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-700">Komentar</h2>
                <a href="{{ route('nongkrong.index') }}"
                    class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Tutup Komentar
                </a>
            </div>

            <!-- Form Tambah Komentar -->
            @auth
                <form action="{{ route('nongkrong.store-reply', $thread->id) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <textarea name="content" id="content" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Tambahkan komentar Anda..." required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            @endauth

            <!-- Daftar Komentar -->
            <div class="space-y-6">
                @foreach ($thread->replies as $reply)
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ $reply->user->first_name[0] }}
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-gray-800">{{ $reply->user->first_name }}
                                    @if ($reply->user->id == $thread->user->id)
                                        <span class="bg-slate-600 text-white text-xs p-1 rounded-full">Author</span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($reply->created_at)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">{{ $reply->content }}</p>
                    </div>
                @endforeach
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
