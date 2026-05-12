@extends('layouts.app')

@section('header_title', 'Konfigurasi Parameter DSS')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Pengaturan Algoritma</h2>
            <p class="text-sm text-gray-500 mt-1">Sesuaikan bobot kriteria dan faktor perhitungan seleksi pemain.</p>
        </div>
        @if(session('success'))
            <div class="flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-lg border border-green-200 text-sm animate-pulse">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form action="{{ route('admin.dss.update') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Bobot Optimasi MOORA</h3>
                    <p class="text-xs text-gray-500 mt-1">Tentukan kepentingan relatif dari setiap aspek penilaian.</p>
                </div>
                <div class="p-6 space-y-5">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aspek Fisik (W1)</label>
                            <div class="flex items-center">
                                <input type="number" name="weight_physical" step="0.01" min="0" max="1" value="{{ old('weight_physical', $settings->weight_physical ?? 0.30) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                                <span class="ml-3 text-gray-400 text-xs font-mono">30%</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aspek Teknis (W2)</label>
                            <div class="flex items-center">
                                <input type="number" name="weight_technical" step="0.01" min="0" max="1" value="{{ old('weight_technical', $settings->weight_technical ?? 0.45) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                                <span class="ml-3 text-gray-400 text-xs font-mono">45%</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aspek Taktis (W3)</label>
                            <div class="flex items-center">
                                <input type="number" name="weight_tactical" step="0.01" min="0" max="1" value="{{ old('weight_tactical', $settings->weight_tactical ?? 0.25) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                                <span class="ml-3 text-gray-400 text-xs font-mono">25%</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-orange-50 rounded-lg border border-orange-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-orange-800 uppercase">Total Akumulasi Bobot</span>
                        <span class="text-sm font-bold text-orange-800">1.00 (100%)</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Analisis Kesenjangan (GAP)</h3>
                    <p class="text-xs text-gray-500 mt-1">Atur persentase pengaruh Core dan Secondary Factor.</p>
                </div>
                <div class="p-6 space-y-8">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Core Factor (Utama)</label>
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-bold">{{ ($settings->core_factor_pct ?? 0.60) * 100 }}%</span>
                        </div>
                        <input type="range" name="core_factor_pct" min="0" max="1" step="0.05" value="{{ old('core_factor_pct', $settings->core_factor_pct ?? 0.60) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600">
                        <p class="mt-2 text-[11px] text-gray-500 leading-relaxed">Kriteria yang paling menonjol dan wajib dimiliki sesuai dengan kebutuhan posisi pemain.</p>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Secondary Factor (Pendukung)</label>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-bold">{{ ($settings->secondary_factor_pct ?? 0.40) * 100 }}%</span>
                        </div>
                        <input type="range" name="secondary_factor_pct" min="0" max="1" step="0.05" value="{{ old('secondary_factor_pct', $settings->secondary_factor_pct ?? 0.40) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600">
                        <p class="mt-2 text-[11px] text-gray-500 leading-relaxed">Kriteria pendukung yang menjadi nilai tambah bagi profil kompetensi pemain.</p>
                    </div>

                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-100 flex items-start">
                        <svg class="w-5 h-5 text-orange-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-orange-800 leading-relaxed font-medium">Perubahan pada parameter ini akan langsung mempengaruhi hasil perangkingan pada proses seleksi berikutnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center pt-4">
            <button type="submit" class="inline-flex items-center justify-center px-12 py-3 text-sm font-bold text-white bg-orange-600 border border-transparent rounded-xl hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-xl transition-all duration-200">
                Update Konfigurasi Sistem
            </button>
        </div>
    </form>
</div>
@endsection