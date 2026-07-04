@extends('layouts.app')

@section('header_title', 'Tambah Pemain Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Informasi Pemain</h3>
            <p class="text-sm text-gray-500 mt-1">Masukkan data diri dan detail profil pemain baru.</p>
        </div>
        
        <form action="{{ route('admin.players.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="Contoh: Budi Santoso">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date" required value="{{ old('birth_date') }}" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Posisi Utama</label>
                    <select name="position" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="">-- Pilih Posisi --</option>
                        <option value="Forward" {{ old('position') == 'Forward' ? 'selected' : '' }}>Forward (Penyerang)</option>
                        <option value="Midfielder" {{ old('position') == 'Midfielder' ? 'selected' : '' }}>Midfielder (Gelandang)</option>
                        <option value="Defender" {{ old('position') == 'Defender' ? 'selected' : '' }}>Defender (Bertahan)</option>
                        <option value="Goalkeeper" {{ old('position') == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper (Kiper)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelompok Usia</label>
                    <select name="age_group" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="">-- Pilih Kelompok Usia --</option>
                        <option value="U-13" {{ old('age_group') == 'U-13' ? 'selected' : '' }}>U-13</option>
                        <option value="U-15" {{ old('age_group') == 'U-15' ? 'selected' : '' }}>U-15</option>
                        <option value="U-17" {{ old('age_group') == 'U-17' ? 'selected' : '' }}>U-17</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Musim Bergabung</label>
                    <input type="number" name="joined_season" required min="2000" max="2099" step="1" value="{{ old('joined_season', date('Y')) }}" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Pemain (Opsional)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.players.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    Simpan Pemain
                </button>
            </div>
        </form>
    </div>
</div>
@endsection