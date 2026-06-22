<div class="h-full bg-white border-r border-gray-200 w-64 fixed top-0 left-0 z-20 flex flex-col transition-transform duration-300">
    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center text-white mr-3 shadow-sm">
            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0zM144.5 125l52.1 63.6-28.7 78.9-80.9 14.8c-10.7-31.9-10.4-66.2 1.4-98 11.2-30.5 30.6-57.5 56.1-79.3zm199 142.5l-28.7-78.9 52.1-63.6c25.5 21.8 44.9 48.8 56.1 79.3 11.8 31.8 12.1 66.1 1.4 98l-80.9-14.8zm-155.1 48l67.6 22 17.5 82.2-41.5 61.4c-35-11.4-66.6-31.7-91.8-59.2l48.2-106.4zm135.2 0l48.2 106.4c-25.2 27.5-56.8 47.8-91.8 59.2l-41.5-61.4 17.5-82.2 67.6-22zm-67.6-146.4l28.7 78.9H220.8l28.7-78.9 6.5-117.8c16.3-1 32.7-1 49 0l-6.5 117.8z"/>
            </svg>
        </div>
        <span class="text-lg font-bold text-gray-900 tracking-tight">DSS<span class="text-orange-600">Sumberharjo</span></span>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 relative">
        <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard Admin
            </a>

            <a href="{{ route('admin.players.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('admin.players.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.players.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Database Pemain
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('admin.users.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Manajemen Pelatih
            </a>

            <a href="{{ route('admin.dss.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('admin.dss.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dss.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Parameter DSS
            </a>

            <a href="{{ route('admin.guidelines.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('admin.guidelines.index') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.guidelines.index') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Panduan Penilaian
            </a>
        @endif

        @if(auth()->user()->role === 'pelatih')
            <a href="{{ route('pelatih.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('pelatih.dashboard') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pelatih.dashboard') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard Pelatih
            </a>

            <a href="{{ route('pelatih.assessments.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('pelatih.assessments.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pelatih.assessments.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Manajemen Skuad
            </a>

            <a href="{{ route('pelatih.selection.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('pelatih.selection.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pelatih.selection.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                Proses Seleksi
            </a>

            <a href="{{ route('pelatih.analytics.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('pelatih.analytics.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pelatih.analytics.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Analitik Pemain
            </a>

            <a href="{{ route('pelatih.guidelines.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors group {{ request()->routeIs('pelatih.guidelines.index') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pelatih.guidelines.index') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Panduan Penilaian
            </a>
        @endif
    </div>

    <div class="border-t border-gray-100 p-4">
        <div class="flex items-center mb-4">
            <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-sm font-bold text-gray-700 border border-gray-200">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3 overflow-hidden">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-transparent focus:ring-2 focus:ring-red-200 outline-none">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</div>