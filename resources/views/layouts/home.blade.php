@extends('layouts.base')



@section('content')

    <body class="bg-gray-800 font-poppin min-h-screen">
        <!-- Navbar -->
        <nav class="bg-gray-900 p-4 flex text-white justify-between items-center h-16">

            <div class="flex items-center gap-4 h-full flex-grow">
                <h1 class="text-2xl font-bold text-white">Sina<span class="text-purple-400">W</span></h1>
                <ul class="flex gap-10 justify-center items-center flex-grow">
                    <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
                    <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
                    <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
                    <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
                </ul>
            </div>

            @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('quiz.create') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                        + Buat Kuis
                    </a>
                    <a href="{{ route('quiz.index-mine') }}"
                        class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
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
            @endauth
        </nav>

        @yield ('Home_content')
    @endsection
