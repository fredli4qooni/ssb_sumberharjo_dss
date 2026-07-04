@extends('layouts.app')

@section('header_title', 'Profil Pelatih')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-orange-50 border-b border-orange-100 px-6 py-4">
            <h3 class="text-lg font-bold text-orange-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Informasi Profil
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('pelatih.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-6 mb-6">
                        <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center font-bold text-2xl text-orange-700 border border-orange-200 overflow-hidden">
                            @if($user->photo)
                                <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil (Opsional)</label>
                            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-800 mb-4">Ubah Password <span class="text-gray-400 font-normal">(Kosongkan jika tidak ingin mengubah)</span></h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" name="password" class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                                @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
