@extends('layouts.home')

@section('title', 'Nongkrong | SinaW')

@section('Home_content')


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
              <button class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                💬 12
              </button>
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
              <button class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                💬 4
              </button>
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

