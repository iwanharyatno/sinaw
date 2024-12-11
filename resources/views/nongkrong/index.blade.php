@extends('layouts.home')

@section('title', 'Nongkrong | SinaW')

@section('content')

<nav class="bg-gray-900 p-4 flex justify-between items-center h-16">

  <div class="flex items-center text-white gap-4 h-full flex-grow">
  <h1 class="text-2xl font-bold text-white">Sina<span class="text-purple-400">W</span></h1>
  <ul class="flex gap-10 justify-center items-center flex-grow">
    <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
    <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
    <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
    <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
  </ul>
</div>

  
      <div class="flex items-center gap-4">
        <a href="{{ route('nongkrong.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
          + Tuliskan
        </a>
        <a href="" class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
          Update Saya
        </a>
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-white font-bold">{{ auth()->user()->first_name[0] }}</span> <!-- Ganti dengan gambar profil -->
        </div>
      </div>
  
  </nav>

<div class="bg-blue-950">

   
    
      <!-- Main Content -->
      <div class="p-8 flex gap-8">
        <!-- Left Column -->
        <div class="flex-grow">
          <!-- Input untuk Postingan -->
          <div class="bg-white text-black  p-4 rounded-lg mb-6">
            <input
              type="text"
              placeholder="Bagaimana update hari ini?"
              class="w-full bg-slate-50 border-2 px-4 py-2 rounded-lg focus:outline-none"
            />
          </div>
    
          <!-- Postingan -->
          <div class="bg-white p-6 rounded-lg mb-6">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-12 h-12 rounded-full bg-red-500"></div>
              <div>
                <h3 class="font-bold text-black">Lorem Ipsum</h3>
                <p class="text-black text-sm">10 November 2024</p>
              </div>
            </div>
            <h4 class="font-bold text-lg mb-2 text-black">
              Lorem Ipsum Dolor sit amet consectetur adipisicing elit, aliquam nulla.
            </h4>
            <p class="text-black mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris euismod
              dignissim sapien in tincidunt. Integer at malesuada fames ac ante ipsum primis in faucibus.
            </p>
            <div class="flex items-center gap-4">
              <button class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                👍 10
              </button>
              <a href="{{ route ('nongkrong.reply')}}" class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                💬 12
              </a>
            </div>
          </div>
    
          <!-- Tambahkan Postingan Lagi -->
          <div class="bg-white p-6 rounded-lg mb-6">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-12 h-12 rounded-full bg-red-500"></div>
              <div>
                <h3 class="font-bold text-black">Lorem Ipsum</h3>
                <p class="text-black text-sm">10 November 2024</p>
              </div>
            </div>
            <h4 class="font-bold text-lg mb-2 text-black">
              Lorem Ipsum Dolor sit amet consectetur adipisicing elit, aliquam nulla.
            </h4>
            <p class="text-black mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris euismod
              dignissim sapien in tincidunt. Integer at malesuada fames ac ante ipsum primis in faucibus.
            </p>
            <div class="flex items-center gap-4">
              <button class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                👍 8
              </button>
              <a href="{{ route ('nongkrong.reply')}}" class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                💬 4
              </a>
            </div>
          </div>
        </div>
    
        <!-- Right Column -->
        <div class="w-1/3 bg-white p-6 rounded-lg">
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



@endsection

