@extends('layouts.app')

@section('header_title', 'Edit Akun Pelatih')

@section('content')
<div class="max-w-3xl mx-auto">
    
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input Anda:</h3>
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
            <h3 class="text-base font-semibold text-gray-900">Update Profil: {{ $user->name }}</h3>
            <p class="text-sm text-gray-500 mt-1">Perbarui detail akun dan hak akses staf pelatih.</p>
        </div>
        
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="px-6 py-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Utama</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Lisensi</label>
                    <select name="license_type" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="AFC Pro" {{ old('license_type', $user->license_type) == 'AFC Pro' ? 'selected' : '' }}>AFC Pro</option>
                        <option value="AFC A" {{ old('license_type', $user->license_type) == 'AFC A' ? 'selected' : '' }}>AFC A</option>
                        <option value="AFC B" {{ old('license_type', $user->license_type) == 'AFC B' ? 'selected' : '' }}>AFC B</option>
                        <option value="Lisensi Nasional" {{ old('license_type', $user->license_type) == 'Lisensi Nasional' ? 'selected' : '' }}>Lisensi Nasional</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Akses</label>
                    <select name="status" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif (Bisa Login)</option>
                        <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Ditangguhkan)</option>
                    </select>
                </div>

                <div class="md:col-span-2 mt-2 p-5 bg-gray-50 border border-gray-200 rounded-lg">
                    <label class="block text-sm font-medium text-gray-900 mb-1">Ganti Kata Sandi</label>
                    <p class="text-xs text-gray-500 mb-3">Kosongkan kolom ini jika Anda tidak ingin mengubah kata sandi pelatih.</p>
                    <input type="password" name="password" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="Ketik kata sandi baru (opsional)...">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                    Kembali
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection