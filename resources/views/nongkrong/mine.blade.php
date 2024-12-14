@extends('layouts.base')

@section('title', 'Riwayat Tulisan | SINAW')

@section('content')
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
    <div class="flex items-center gap-4">
        <a href="{{ route('nongkrong.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
            + Tuliskan
        </a>
        <a href="{{ route('nongkrong.mine') }}" class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
            Tulisan Saya
        </a>
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
            <span class="text-white font-bold">{{ auth()->user()->first_name[0] }}</span>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Riwayat Tulisan Saya</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      
        <div class="bg-gray-100 shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800"></h3>
            <p class="text-sm text-gray-600 mb-2"></p>
            <p class="text-xs text-gray-500 mb-4">Dipublikasikan pada </p>
            <div class="flex gap-4">
                <a href="" class="text-blue-500 hover:underline">Lihat</a>
                <a href="" class="text-yellow-500 hover:underline">Edit</a>
                <form action="" method="POST" class="inline">
                   
                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
      

       
        <p class="text-gray-500">Anda belum memiliki tulisan.</p>
       
    </div>
</div>
@endsection
