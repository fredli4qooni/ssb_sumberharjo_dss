@extends('layouts.app')

@section('header_title', 'Konfigurasi Parameter DSS (PM-MOORA)')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Pengaturan Algoritma</h2>
            <p class="text-sm text-gray-500 mt-1">Sesuaikan bobot kriteria MOORA dan persentase GAP Profile Matching.</p>
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
                    <p class="text-xs text-gray-500 mt-1">Tentukan prioritas dari setiap aspek penilaian.</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fisik (Benefit)</label>
                            <input type="number" name="weight_physical" step="0.01" min="0" max="1" value="{{ old('weight_physical', $settings->weight_physical ?? 0.25) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teknis (Benefit)</label>
                            <input type="number" name="weight_technical" step="0.01" min="0" max="1" value="{{ old('weight_technical', $settings->weight_technical ?? 0.30) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Taktis (Benefit)</label>
                            <input type="number" name="weight_tactical" step="0.01" min="0" max="1" value="{{ old('weight_tactical', $settings->weight_tactical ?? 0.20) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mental (Benefit)</label>
                            <input type="number" name="weight_mental" step="0.01" min="0" max="1" value="{{ old('weight_mental', $settings->weight_mental ?? 0.15) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                    </div>
                    
                    <hr class="border-gray-100 my-2">
                    
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-2">Ketidakhadiran (Cost)</label>
                        <input type="number" name="weight_ketidakhadiran" step="0.01" min="0" max="1" value="{{ old('weight_ketidakhadiran', $settings->weight_ketidakhadiran ?? 0.10) }}" class="w-full px-4 py-2 bg-red-50 border border-red-300 rounded-lg text-sm focus:ring-2 focus:ring-red-500 outline-none">
                        <p class="text-[10px] text-gray-500 mt-1">Bobot pengurang skor (Cost) dalam MOORA.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Analisis Kesenjangan (GAP PM)</h3>
                    <p class="text-xs text-gray-500 mt-1">Atur persentase Core dan Secondary Factor Profile Matching.</p>
                </div>
                <div class="p-6 space-y-8">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Core Factor (Utama)</label>
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-bold">{{ ($settings->core_factor_pct ?? 0.60) * 100 }}%</span>
                        </div>
                        <input type="range" name="core_factor_pct" min="0" max="1" step="0.05" value="{{ old('core_factor_pct', $settings->core_factor_pct ?? 0.60) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Secondary Factor (Pendukung)</label>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-bold">{{ ($settings->secondary_factor_pct ?? 0.40) * 100 }}%</span>
                        </div>
                        <input type="range" name="secondary_factor_pct" min="0" max="1" step="0.05" value="{{ old('secondary_factor_pct', $settings->secondary_factor_pct ?? 0.40) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600">
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