@extends('layouts.base')

@section('title', 'Tambah Update Baru | SINAW')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Komentar</h2>

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
            <!-- Komentar 1 -->
            @foreach ($thread->replies as $reply)
                <div class="p-4 bg-gray-100 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div
                            class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ $reply->user->first_name[0] }}
                        </div>
                        <div class="ml-4">
                            <p class="font-bold text-gray-800">{{ $reply->user->first_name }} @if ($reply->user->id == $thread->user->id)
                                    <span class="bg-slate-600 text-white text-xs p-1 rounded-full">Author</span>
                                @endif
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($reply->created_at)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">{{ $reply->content }}</p>
                    <!-- Tombol Reply -->
                    {{-- <button
                class="text-sm text-blue-600 hover:underline focus:outline-none"
                onclick="document.getElementById('reply-form-{{ $loop->index }}').classList.toggle('hidden')"
            >
                Balas
            </button> --}}
                    <!-- Form Reply -->
                    {{-- <form
                action="{{  }}"
                method="POST"
                id="reply-form-{{ $loop->index }}"
                class="hidden mt-4"
            >
                
                <textarea
                    name="reply"
                    id="reply"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Tulis balasan Anda di sini..."
                    required
                ></textarea>
                <div class="flex justify-end mt-2">
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                        Kirim Balasan
                    </button>
                </div>
            </form> --}}
                </div>
            @endforeach
        </div>
    </div>
@endsection
