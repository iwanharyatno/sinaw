@extends('layouts.base')

@section('content')

    <body class="bg-gray-800 font-poppins min-h-screen">
        <!-- Navbar -->
        <nav class="bg-gray-900 p-4 flex text-white justify-between items-center h-16 relative">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <img src="{{ asset('asset/sinaw-logo.png') }}" alt="SinaW Logo" class="h-10">

            </div>

            <!-- Menu -->
            <div class="hidden md:flex items-center gap-10 flex-grow">
                <ul class="flex gap-10 justify-center items-center flex-grow">
                    <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
                    <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
                    <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
                    <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
                </ul>
            </div>

            <!-- Auth Buttons -->
            @auth
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('quiz.create') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                        + Buat Kuis
                    </a>
                    <a href="{{ route('quiz.index-mine') }}"
                        class="bg-purple-700 text-white  px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
                        Kuis Saya
                    </a>
                    <div class="relative rounded-full group p-2 text-black">
                        <img src="{{ auth()->user()->avatar ? '/image/' . auth()->user()->avatar : 'https://via.placeholder.com/64' }}"
                            alt="Profile" class="w-10 h-10 rounded-full">
                        <div class="absolute divide-y top-full right-0 w-44 bg-white rounded-md -mt-1 hidden group-hover:block">
                            <ul>
                                <li class="px-4 py-2 border-b-2"><strong>Account</strong></li>
                                <li><a href="{{ route('user.profile') }}"
                                        class="block w-full text-left px-4 py-2 hover:bg-slate-300 rounded-b-md">Edit
                                        Profile</a></li>
                                <li>
                                    <form class="block" method="POST" action="{{ route('home.logout') }}">
                                        @csrf
                                        <button
                                            class="block w-full text-left px-4 py-2 hover:bg-slate-300 rounded-b-md">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex gap-4">
                    <a href="{{ route('home.register') }}"
                        class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Daftar</a>
                    <a href="{{ route('home.login') }}"
                        class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Masuk</a>
                </div>
            @endauth

            <!-- Hamburger Menu -->
            <div class="md:hidden flex items-center">
                <button id="hamburger" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar -->
            <div id="sidebar"
                class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white z-50 transform -translate-x-full transition-transform duration-300">
                <div class="p-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white">Sina<span class="text-purple-400">W</span></h1>
                    <button id="close-sidebar" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <ul class="p-4">
                    <li><a href="{{ route('home.index') }}"
                            class="block py-2 px-4 hover:bg-gray-700 rounded-md">Beranda</a>
                    </li>
                    <li><a href="{{ route('aktivitas.index') }}"
                            class="block py-2 px-4 hover:bg-gray-700 rounded-md">Aktivitas
                            Saya</a></li>
                    <li><a href="{{ route('nongkrong.index') }}"
                            class="block py-2 px-4 hover:bg-gray-700 rounded-md">Nongkrong</a>
                    </li>
                    <li><a href="{{ route('quiz.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Kuis</a>
                    </li>
                </ul>
                <div class="p-4">
                    @auth
                        <a href="{{ route('quiz.create') }}"
                            class="block bg-green-500 text-center text-white py-2 px-4 rounded-md hover:bg-green-600 mb-4">
                            + Buat Kuis
                        </a>
                        <a href="{{ route('quiz.index-mine') }}"
                            class="block bg-transparent text-center text-green-500 py-2 px-4 rounded-md hover:bg-green-500 hover:text-white">
                            Kuis Saya
                        </a>
                        <form method="POST" action="{{ route('home.logout') }}">
                            @csrf
                            <button class="block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 mt-4">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>

        @yield ('Home_content')

        <script>
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');

            hamburger.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
            });

            closeSidebar.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });
        </script>
    </body>
@endsection
