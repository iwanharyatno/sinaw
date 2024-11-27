@extends('layouts.base')

@section('title', 'Home | SINAW')

@section('content')
<div class="text-white bg-gradient-to-b from-[#3A4561] to-[#0B1735] min-h-screen">
    <nav>
        <ul class="p-4 flex justify-between gap-4 items-center font-inter">
            <li><h1 class="text-2xl font-bold font-fredoka">SinaW</h1></li>
            <li class="ml-auto"><a href="/login" class="hover:underline">Login</a></li>
            <li><a href="/register" class="inline-block px-4 py-2 bg-[#B9295A] rounded-md">Daftar</a></li>
        </ul>
    </nav>
</div>
@endsection