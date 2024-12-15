@extends('layouts.home')

@section('title', 'Update Profile | SINAW')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Edit Profile</h2>
    <form action="{{ route('user.profile-save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex gap-4">
            <div class="mb-4 flex-1">
                <label for="first_name" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                <input
                    type="text"
                    name="first_name"
                    id="first_name"
                    class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nama Depan"
                    required
                    value="{{ $user->first_name }}"
                />
            </div>
            <div class="mb-4 flex-1">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nama Belakang"
                    required
                    value="{{ $user->last_name }}"
                />
            </div>
        </div>
        <div class="mb-4 flex-1">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Nama Belakang"
                required
                value="{{ $user->email }}"
            />
        </div>
        <div class="mb-4 flex-1">
            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
            <img src="{{ asset('image/' . $user->avatar) }}" alt="" style="width: 4rem; height: 4rem" class="rounded-full bg-gray-200" id="avatarPreview">
            <input
                type="file"
                name="avatar"
                id="avatar"
                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
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
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        const avatarInput = document.getElementById('avatar');
        avatarInput.addEventListener('change', function() {
            const preview = document.getElementById('avatarPreview');
            preview.src = URL.createObjectURL(this.files[0]);
        });
    </script>
@endpush