@extends('layouts.app')

@section('header_title', 'Edit Data Pemain')

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
            <h3 class="text-base font-semibold text-gray-900">Update Profil: {{ $player->name }}</h3>
            <p class="text-sm text-gray-500 mt-1">ID Pemain: #SH-{{ str_pad($player->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        
        <form action="{{ route('admin.players.update', $player->id) }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $player->name) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $player->birth_date) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Posisi Utama</label>
                    <select name="position" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="Forward" {{ old('position', $player->position) == 'Forward' ? 'selected' : '' }}>Forward</option>
                        <option value="Midfielder" {{ old('position', $player->position) == 'Midfielder' ? 'selected' : '' }}>Midfielder</option>
                        <option value="Defender" {{ old('position', $player->position) == 'Defender' ? 'selected' : '' }}>Defender</option>
                        <option value="Goalkeeper" {{ old('position', $player->position) == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelompok Usia</label>
                    <select name="age_group" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                        <option value="U-13" {{ old('age_group', $player->age_group) == 'U-13' ? 'selected' : '' }}>U-13</option>
                        <option value="U-15" {{ old('age_group', $player->age_group) == 'U-15' ? 'selected' : '' }}>U-15</option>
                        <option value="U-17" {{ old('age_group', $player->age_group) == 'U-17' ? 'selected' : '' }}>U-17</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Musim Bergabung</label>
                    <input type="number" name="joined_season" value="{{ old('joined_season', $player->joined_season) }}" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Pemain (Opsional)</label>
                    @if($player->photo)
                        <div class="mb-3">
                            <img src="{{ Storage::url($player->photo) }}" alt="Foto {{ $player->name }}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG. Maks: 2MB.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.players.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
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