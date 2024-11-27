@extends('layouts.base')

@section('title', 'Tambah Quiz Baru | SINAW')

@section('content')
    <div class="bg-gray-100">
        <form class="max-w-4xl mx-auto p-4">
            <div class="flex items-center mb-4">
                <i class="fas fa-arrow-left text-2xl"></i>
                <h1 class="text-2xl font-bold ml-2">Buat Kuis Baru</h1>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <input type="text" placeholder="Tuliskan judul kuis" class="w-full p-2 mb-4 border rounded-lg">
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center mb-4 rounded-lg">
                    <span class="text-gray-500">Ubah Cover</span>
                </div>
                <div class="space-y-4">
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <input type="text" placeholder="Tuliskan soal..." class="w-full p-2 mb-2 border rounded-lg">
                        <div class="flex items-center mb-2">
                            <button class="flex items-center text-red-500">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah Media
                            </button>
                            <select class="ml-auto p-2 border rounded-lg">
                                <option>Isian Singkat</option>
                            </select>
                        </div>
                        <input type="text" placeholder="Jawaban benar" class="w-full p-2 border rounded-lg">
                    </div>
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <input type="text" placeholder="Tuliskan soal..." class="w-full p-2 mb-2 border rounded-lg">
                        <div class="flex items-center mb-2">
                            <button class="flex items-center text-red-500">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah Media
                            </button>
                            <select class="ml-auto p-2 border rounded-lg">
                                <option>Pilihan Ganda</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="text" placeholder="Opsi 1" class="w-full p-2 border rounded-lg">
                                <input type="checkbox" class="ml-2">
                            </div>
                            <div class="flex items-center">
                                <input type="text" placeholder="Opsi 1" class="w-full p-2 border rounded-lg">
                                <input type="checkbox" class="ml-2">
                            </div>
                            <div class="flex items-center">
                                <input type="text" placeholder="Opsi 1" class="w-full p-2 border rounded-lg">
                                <input type="checkbox" class="ml-2">
                            </div>
                            <button class="w-full p-2 text-blue-500 border rounded-lg">+ Tambah opsi jawaban</button>
                        </div>
                    </div>
                </div>
                <button class="w-full p-2 mt-4 text-blue-500 border rounded-lg">+ Tambah soal baru</button>
            </div>
            <div class="mt-4 p-4 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-bold mb-2">Pengaturan</h2>
                <div class="space-y-2">
                    <div>
                        <label for="topic" class="block mb-1">Topik</label>
                        <select id="topic" class="w-full p-2 border rounded-lg">
                            <option>Sains</option>
                        </select>
                    </div>
                    <div>
                        <label for="publish-date" class="block mb-1">Tanggal Publikasi</label>
                        <input type="date" id="publish-date" class="w-full p-2 border rounded-lg" value="2024-11-10">
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button class="px-4 py-2 text-white bg-blue-500 rounded-lg" name="action">Simpan</button>
                <button class="px-4 py-2 text-white bg-green-500 rounded-lg" name="action">Publikasi</button>
            </div>
        </form>
    </div>
@endsection