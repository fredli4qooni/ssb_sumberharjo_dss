@extends('layouts.app')

@section('header_title', 'Pengaturan Aplikasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Ubah Tampilan & Identitas</h3>
            <p class="text-sm text-gray-500 mt-1">Sesuaikan nama, logo, dan tema warna aplikasi Anda di sini.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Identitas Aplikasi -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-gray-900 border-b pb-2">Identitas Aplikasi</h4>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                    <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Aplikasi Saat Ini</label>
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-24 bg-gray-50 rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden p-2">
                            @if($setting->app_logo)
                                <img src="{{ Storage::url($setting->app_logo) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                            @else
                                <div class="text-gray-400 flex flex-col items-center">
                                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-medium">Kosong</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Logo Baru</label>
                            <input type="file" name="app_logo" accept="image/*" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG. Maks: 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tema Warna -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-gray-900 border-b pb-2">Tema Warna</h4>
                <p class="text-sm text-gray-500 mb-3">Pilih tema warna dominan untuk aplikasi ini.</p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Tema Oranye/Emas -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="theme_color" value="orange" class="peer sr-only" {{ old('theme_color', $setting->theme_color) == 'orange' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all text-center">
                            <div class="w-8 h-8 mx-auto rounded-full bg-orange-500 mb-2 shadow-sm"></div>
                            <span class="text-sm font-semibold text-gray-700 peer-checked:text-orange-700">Emas (Default)</span>
                        </div>
                    </label>

                    <!-- Tema Biru -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="theme_color" value="blue" class="peer sr-only" {{ old('theme_color', $setting->theme_color) == 'blue' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                            <div class="w-8 h-8 mx-auto rounded-full bg-blue-500 mb-2 shadow-sm"></div>
                            <span class="text-sm font-semibold text-gray-700 peer-checked:text-blue-700">Biru</span>
                        </div>
                    </label>

                    <!-- Tema Hijau -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="theme_color" value="green" class="peer sr-only" {{ old('theme_color', $setting->theme_color) == 'green' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all text-center">
                            <div class="w-8 h-8 mx-auto rounded-full bg-green-500 mb-2 shadow-sm"></div>
                            <span class="text-sm font-semibold text-gray-700 peer-checked:text-green-700">Hijau</span>
                        </div>
                    </label>

                    <!-- Tema Merah -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="theme_color" value="red" class="peer sr-only" {{ old('theme_color', $setting->theme_color) == 'red' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all text-center">
                            <div class="w-8 h-8 mx-auto rounded-full bg-red-500 mb-2 shadow-sm"></div>
                            <span class="text-sm font-semibold text-gray-700 peer-checked:text-red-700">Merah</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex items-center justify-end">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
