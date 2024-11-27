@extends('layouts.base')

@section('title', 'Home | SINAW')

@section('content')
<div class=" font-poppins bg-gradient-to-b from-gray-800 to-blue-900 min-h-screen flex flex-col">
  <!-- Header -->
  <div class="flex items-center justify-between px-6 py-4">
    <h1 class="text-4xl font-bold text-white">SinaW</h1>
    @auth
        <div class="relative rounded-full group p-2">
            <img src="{{ $user->avatar ? $user->avatar : 'https://via.placeholder.com/64' }}" alt="Profile" class="w-10 h-10 rounded-full">
            <div class="absolute divide-y top-full right-0 w-44 bg-white rounded-md -mt-1 hidden group-hover:block">
                <ul>
                    <li class="px-4 py-2 border-b-2"><strong>Account</strong></li>
                    <li><form class="block" method="POST" action="{{ route('home.logout') }}">
                        @csrf
                        <button class="block w-full text-left px-4 py-2 hover:bg-slate-300 rounded-b-md">Logout</button>
                    </form></li>
                </ul>
            </div>
        </div>
    @else
        <div class="flex gap-4">
            <a href="{{ route('home.register') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Daftar</a>
            <a href="{{ route('home.login') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Masuk</a>
        </div>
    @endauth
  </div>

  <!-- Main Content -->
  <div class="flex-grow flex flex-col items-center justify-center px-6">
    <!-- Welcome Card -->
    <div class="bg-blue-500 text-white rounded-xl p-6 w-full max-w-lg flex items-center justify-between mb-8 shadow-lg">
      <div>
        <p class="text-lg">Selamat Datang!</p>
        @auth
            <h2 class="text-2xl font-bold">{{ $user->first_name }}</h2>
            <p class="flex items-center mt-2">
            <span class="text-yellow-400 text-xl">&#9733;</span>
            <span class="ml-2">Point {{ $user->points }}</span>
            </p>
        @endauth
      </div>
      @auth
        <img src="{{ $user->avatar ? $user->avatar : 'https://via.placeholder.com/64' }}" alt="Profile" class="w-16 h-16 rounded-full">
      @endauth
    </div>

    <!-- Join Code Input -->
    <div class="flex items-center gap-2 mb-6 w-full max-w-lg">
      <input type="text" placeholder="Enter a join code" class="flex-grow px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring focus:ring-blue-300">
      <button class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">Join</button>
    </div>

    <div class=" flex items-center mb-8 ">
        <button class="bg-transparent text-white rounded-lg px-6 py-2 hover:bg-purple-700  "> Create Quiz</button>
    </div>

    <!-- Quiz Options -->
    <div  class="grid grid-cols-2 gap-4 w-full max-w-2xl text-center">
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
          <a href="{{ route('kelas.index') }}">
              <img src="https://via.placeholder.com/64" alt="Kelas" class="mx-auto mb-4">
              <p class="font-bold">Kelas</p>
          </a>
      </div>
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="{{ route('aktivitas.index') }}">
          <img src="https://via.placeholder.com/64" alt="Aktivitas" class="mx-auto mb-4">
          <p class="font-bold">Aktivitas</p>
        </a>
      </div>
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="{{ route('quiz.index') }}">
            <img src="https://via.placeholder.com/64" alt="Jelajahi Kuis" class="mx-auto mb-4">
              <p class="font-bold">Jelajahi Kuis</p>
        </a>
      </div>
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="{{ route('nongkrong.index') }}">
          <img src="https://via.placeholder.com/64" alt="Nongkrong" class="mx-auto mb-4">
          <p class="font-bold">Nongkrong</p>

        </a>
      </div>
    </div>
  </div>
</div>
@endsection