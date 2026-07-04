@extends('layouts.app')

@section('header_title', 'Manajemen Pelatih')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Daftar Staf Pelatih</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola hak akses dan akun pelatih akademi.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pelatih Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pelatih</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_coaches'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm font-medium text-gray-500">Lisensi Pro/A</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pro_licensed'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-1.006 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946 1.006 3.42 3.42 0 013.138 3.138 3.42 3.42 0 001.006 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-1.006 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946 1.006 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-1.006 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-1.006-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 001.006-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm font-medium text-gray-500">Login Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['active_today'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Pelatih</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Lisensi</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Terakhir Login</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($coaches as $coach)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($coach->photo)
                                        <img class="h-10 w-10 rounded-full border border-gray-200 object-cover" src="{{ Storage::url($coach->photo) }}" alt="{{ $coach->name }}">
                                    @else
                                        <img class="h-10 w-10 rounded-full border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode($coach->name) }}&background=EBF8FF&color=2B6CB0" alt="{{ $coach->name }}">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $coach->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $coach->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $coach->license_type ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $coach->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $coach->status == 'aktif' ? 'bg-green-500' : 'bg-red-500' }} mr-1.5"></span>
                                {{ ucfirst($coach->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $coach->last_login_at ? \Carbon\Carbon::parse($coach->last_login_at)->diffForHumans() : 'Belum pernah login' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.users.edit', $coach->id) }}" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-md transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $coach->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelatih ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 text-sm">Belum ada data pelatih terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($coaches->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $coaches->links() }}
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-orange-50 p-5 rounded-xl border border-orange-100 flex items-start">
            <svg class="w-5 h-5 text-orange-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <h4 class="text-sm font-bold text-orange-900">Audit Akses Sistem</h4>
                <p class="text-sm text-orange-700 mt-1">Tinjau secara berkala akun pelatih yang sudah tidak aktif untuk menjaga keamanan data penilaian pemain.</p>
            </div>
        </div>
        <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 flex items-start">
            <svg class="w-5 h-5 text-gray-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <div>
                <h4 class="text-sm font-bold text-gray-900">Bantuan Dukungan IT</h4>
                <p class="text-sm text-gray-600 mt-1">Jika pelatih mengalami kendala login, arahkan untuk menghubungi tim Support Internal SSB.</p>
            </div>
        </div>
    </div>
</div>
@endsection