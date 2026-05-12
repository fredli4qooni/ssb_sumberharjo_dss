@extends('layouts.app')

@section('header_title', 'Form Penilaian Pemain')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center space-x-5">
        <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center font-bold text-xl text-orange-700 border border-orange-100">
            {{ substr($player->name, 0, 1) }}
        </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">{{ $player->name }}</h2>
            <div class="flex items-center gap-3 mt-1 text-sm text-gray-500 font-medium">
                <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-700">{{ $player->age_group }}</span>
                <span class="inline-flex items-center px-2 py-0.5 rounded bg-red-50 text-red-700">{{ $player->position }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('pelatih.assessments.store', $player->id) }}" method="POST">
        @csrf
        
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sesi Penilaian <span class="text-red-500">*</span></label>
                <input type="text" name="session_name" required placeholder="Contoh: Seleksi Musim 2026" class="w-full md:w-1/2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                <p class="text-xs text-gray-500 mt-1.5">Pastikan nama sesi seragam untuk membandingkan pemain di sesi yang sama.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <div class="p-6 space-y-5">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 rounded bg-orange-50 text-orange-600 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h4 class="text-base font-semibold text-gray-900">Aspek Fisik</h4>
                    </div>
                    
                    @foreach(['speed' => 'Kecepatan', 'stamina' => 'Stamina', 'strength' => 'Kekuatan Fisik'] as $field => $label)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                            <span class="text-sm font-bold text-orange-600" id="{{ $field }}_val">3</span>
                        </div>
                        <input type="range" name="{{ $field }}" min="1" max="5" value="3" oninput="document.getElementById('{{ $field }}_val').innerText = this.value" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-orange-500">
                        <div class="flex justify-between text-xs text-gray-400 mt-2 font-medium"><span>1 (Buruk)</span><span>5 (Sangat Baik)</span></div>
                    </div>
                    @endforeach
                </div>

                <div class="p-6 space-y-5">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 rounded bg-orange-50 text-orange-600 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z M15 9a3 3 0 11-6 0 3 3 0 016 0z M9 15h6"/></svg>
                        </div>
                        <h4 class="text-base font-semibold text-gray-900">Aspek Teknis</h4>
                    </div>

                    @foreach(['passing' => 'Akurasi Passing', 'dribbling' => 'Dribbling', 'shooting' => 'Shooting'] as $field => $label)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                            <span class="text-sm font-bold text-orange-600" id="{{ $field }}_val">3</span>
                        </div>
                        <input type="range" name="{{ $field }}" min="1" max="5" value="3" oninput="document.getElementById('{{ $field }}_val').innerText = this.value" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-orange-600">
                        <div class="flex justify-between text-xs text-gray-400 mt-2 font-medium"><span>1 (Buruk)</span><span>5 (Sangat Baik)</span></div>
                    </div>
                    @endforeach
                </div>

                <div class="p-6 space-y-5">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 rounded bg-green-50 text-green-600 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7l5.447-2.724A1 1 0 0116 5.618v10.764a1 1 0 01-1.447.894L9 20z"/></svg>
                        </div>
                        <h4 class="text-base font-semibold text-gray-900">Aspek Taktis</h4>
                    </div>

                    @foreach(['positioning' => 'Positioning', 'vision' => 'Visi Bermain', 'cooperation' => 'Kerjasama Tim'] as $field => $label)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                            <span class="text-sm font-bold text-green-600" id="{{ $field }}_val">3</span>
                        </div>
                        <input type="range" name="{{ $field }}" min="1" max="5" value="3" oninput="document.getElementById('{{ $field }}_val').innerText = this.value" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-green-600">
                        <div class="flex justify-between text-xs text-gray-400 mt-2 font-medium"><span>1 (Buruk)</span><span>5 (Sangat Baik)</span></div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 bg-gray-50/30">
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                <textarea name="coach_notes" rows="3" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all" placeholder="Masukkan observasi spesifik mengenai gaya bermain atau kebugaran pemain..."></textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('pelatih.assessments.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-orange-600 text-white rounded-lg text-sm font-semibold hover:bg-orange-700 focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection