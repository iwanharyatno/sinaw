
@extends('layouts.base')

@section('title', 'Tambah Update Baru | SINAW')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Komentar</h2>
    
    <!-- Form Tambah Komentar -->
    <form action="" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <textarea
                name="comment"
                id="comment"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Tambahkan komentar Anda..."
                required
            ></textarea>
        </div>
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Kirim Komentar
            </button>
        </div>
    </form>

    <!-- Daftar Komentar -->
    <div class="space-y-6">
        <!-- Komentar 1 -->
        <div class="p-4 bg-gray-100 rounded-lg">
            <div class="flex items-center mb-2">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                    A
                </div>
                <div class="ml-4">
                    <p class="font-bold text-gray-800">Ahmad</p>
                    <p class="text-sm text-gray-500">12 Desember 2024</p>
                </div>
            </div>
            <p class="text-gray-700 mb-4">Ini adalah komentar pertama saya di tulisan ini. Bagus sekali!</p>
            <!-- Tombol Reply -->
            <button
                class="text-sm text-blue-600 hover:underline focus:outline-none"
                onclick="document.getElementById('reply-form-1').classList.toggle('hidden')"
            >
                Balas
            </button>
            <!-- Form Reply -->
            <form
                action=""
                method="POST"
                id="reply-form-1"
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
            </form>
        </div>

        <!-- Komentar 2 dengan Reply -->
        <div class="p-4 bg-gray-100 rounded-lg">
            <div class="flex items-center mb-2">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">
                    B
                </div>
                <div class="ml-4">
                    <p class="font-bold text-gray-800">Budi</p>
                    <p class="text-sm text-gray-500">11 Desember 2024</p>
                </div>
            </div>
            <p class="text-gray-700 mb-4">Tulisan ini sangat bermanfaat, terima kasih sudah berbagi.</p>
            <!-- Tombol Reply -->
            <button
                class="text-sm text-blue-600 hover:underline focus:outline-none"
                onclick="document.getElementById('reply-form-2').classList.toggle('hidden')"
            >
                Balas
            </button>
            <!-- Form Reply -->
            <form
                action=""
                method="POST"
                id="reply-form-2"
                class="hidden mt-4"
            >
                @csrf
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
            </form>
            <!-- Reply yang Sudah Ada -->
            <div class="mt-4 space-y-2">
                <div class="p-3 bg-white rounded-md">
                    <p class="text-sm text-gray-700"><strong>Siti:</strong> Saya setuju sekali, tulisan ini memang bagus!</p>
                </div>
                <div class="p-3 bg-white rounded-md">
                    <p class="text-sm text-gray-700"><strong>Ali:</strong> Jangan lupa baca artikel lainnya juga.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection