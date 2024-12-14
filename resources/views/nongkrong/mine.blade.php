@extends('layouts.base')

@section('title', 'Riwayat Tulisan - ' . $user->first_name)

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Riwayat Tulisan oleh {{ $user->first_name }}</h2>
        
        @if ($threads->isEmpty())
            <p class="text-gray-500">Belum ada tulisan yang dibuat oleh {{ $user->first_name }}.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($threads as $thread)
                    <div class="bg-gray-100 shadow-md rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $thread->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ \Str::limit($thread->replies->first()->content ?? 'Tidak ada konten', 100) }}</p>
                        <p class="text-xs text-gray-500 mb-4">
                            Dipublikasikan pada {{ $thread->created_at->format('d M Y H:i') }}
                        </p>
                        <div class="flex gap-4">
                            <a href="{{ route('nongkrong.reply', $thread->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $threads->links() }}
            </div>
        @endif
    </div>
@endsection
