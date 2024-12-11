@extends('layouts.base')

@section('title', 'Tambah Update Baru | SINAW')

@section('content')
<<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Buat Tulisan Baru</h2>
    <form action="" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input
                type="text"
                name="title"
                id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Masukkan judul tulisan"
                required
            />
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Isi</label>
            <textarea
                name="content"
                id="content"
                rows="6"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Tulis isi konten Anda di sini"
                required
            ></textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select
                name="category"
                id="category"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="matematika">Matematika</option>
                <option value="sains">Sains</option>
                <option value="teknologi">Teknologi</option>
                <option value="komputer">Komputer</option>
                <option value="filosofi">Filosofi</option>
            </select>
        </div>
        <div class="flex justify-end space-x-4">
            <a
                href="{{ route('nongkrong.index') }}"
                class="px-6 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400"
            >
                Batal
            </a>
            <button
                type="submit"
                class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
            >
                Unggah Tulisan
            </button>
        </div>
    </form>
</div>


@endsection


