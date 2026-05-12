@extends('layouts.app')

@section('header_title', 'Tambah Pelatih Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Informasi Akun Pelatih</h3>
            <p class="text-sm text-gray-500 mt-1">Buat akun baru untuk memberikan akses sistem ke staf pelatih.</p>
        </div>
        
        <form action="{{ route('admin.users.store') }}" method="POST" class="px-6 py-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="Contoh: Coach Indra">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Utama</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="pelatih@sumberharjo.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Lisensi</label>
                    <select name="license_type" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="">-- Pilih Lisensi --</option>
                        <option value="AFC Pro" {{ old('license_type') == 'AFC Pro' ? 'selected' : '' }}>AFC Pro</option>
                        <option value="AFC A" {{ old('license_type') == 'AFC A' ? 'selected' : '' }}>AFC A</option>
                        <option value="AFC B" {{ old('license_type') == 'AFC B' ? 'selected' : '' }}>AFC B</option>
                        <option value="Lisensi Nasional" {{ old('license_type') == 'Lisensi Nasional' ? 'selected' : '' }}>Lisensi Nasional</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Sementara</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="Minimal 8 karakter">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection