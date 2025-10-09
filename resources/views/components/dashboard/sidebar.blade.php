<!-- Sidebar Desktop -->
<div
    class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 text-white hidden md:flex md:flex-col fixed left-0 top-0 h-screen w-64 shadow-2xl z-50 transform transition-transform duration-300 ease-in-out">
    <!-- Header -->
    <div class="flex items-center justify-center py-6 px-4 border-b border-blue-700/50 bg-blue-900/50 backdrop-blur-sm">
        <div class="flex items-center space-x-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg animate-pulse">
                <i class="fas fa-chart-line text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                    Sistem Lembur
                </h1>
                <p class="text-xs text-blue-300">Dashboard</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-800/30 px-2">
        <nav class="py-6 space-y-1">
            <!-- Overview -->
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                <div
                    class="w-8 h-8 bg-blue-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-500 transition-all duration-300 group-hover:rotate-12">
                    <i class="fas fa-home text-sm"></i>
                </div>
                <span class="font-medium">Overview</span>
                @if (request()->routeIs('dashboard'))
                    <div class="ml-auto w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- Admin & Management Menu -->
            @if (Auth::user()->hasAnyRole(['Pimpinan', 'HRD']))
                <div class="pt-6">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-4 px-4">Management</p>
                    @if (Auth::user()->hasRole('HRD'))
                        <a href="{{ route('jabatan.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('jabatan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                            <div
                                class="w-8 h-8 bg-purple-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-briefcase text-sm"></i>
                            </div>
                            <span class="font-medium">Jabatan</span>
                        </a>

                        <a href="{{ route('departemen.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('departemen.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                            <div
                                class="w-8 h-8 bg-green-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-building text-sm"></i>
                            </div>
                            <span class="font-medium">Departemen</span>
                        </a>


                        </a>
                    @endif
                    <a href="{{ route('karyawan.index') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('karyawan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                        <div
                            class="w-8 h-8 bg-indigo-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-indigo-500 transition-all duration-300 group-hover:rotate-12">
                            <i class="fas fa-users text-sm"></i>
                        </div>
                        <span class="font-medium">Karyawan</span>
                        <a href="{{ route('catatan-lembur.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('catatan-lembur.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                            <div
                                class="w-8 h-8 bg-yellow-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-clock text-sm"></i>
                            </div>
                            <span class="font-medium">Catatan Lembur</span>
                        </a>

                        <a href="{{ route('persetujuan.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('persetujuan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                            <div
                                class="w-8 h-8 bg-emerald-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-emerald-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-check-circle text-sm"></i>
                            </div>
                            <span class="font-medium">Persetujuan</span>
                        </a>

                        <a href="{{ route('upah.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('upah.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                            <div
                                class="w-8 h-8 bg-orange-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-money-bill-wave text-sm"></i>
                            </div>
                            <span class="font-medium">Upah</span>
                        </a>
                </div>
            @else
                <div class="pt-6">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-4 px-4">Menu</p>
                    <a href="{{ route('catatan-lembur.index') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('catatan-lembur.create') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                        <div
                            class="w-8 h-8 bg-yellow-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-500 transition-all duration-300 group-hover:rotate-12">
                            <i class="fas fa-plus text-sm"></i>
                        </div>
                        <span class="font-medium">Ajukan Lembur</span>
                    </a>

                    <a href="{{ route('persetujuan.index') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('persetujuan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                        <div
                            class="w-8 h-8 bg-emerald-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-emerald-500 transition-all duration-300 group-hover:rotate-12">
                            <i class="fas fa-check-circle text-sm"></i>
                        </div>
                        <span class="font-medium">Status Persetujuan</span>
                    </a>

                    <a href="{{ route('karyawan.show', Auth::user()->karyawan->id) }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('karyawan.show') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                        <div
                            class="w-8 h-8 bg-indigo-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-indigo-500 transition-all duration-300 group-hover:rotate-12">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span class="font-medium">Data Saya</span>
                    </a>
                </div>
            @endif

            <!-- Profile -->
            {{-- <div class="pt-6">
                <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-4 px-4">Account</p>
                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('profile.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}">
                    <div
                        class="w-8 h-8 bg-gray-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-500 transition-all duration-300 group-hover:rotate-12">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <span class="font-medium">Profile</span>
                </a>
            </div> --}}
        </nav>
    </div>

    <!-- User Info & Logout -->
    <div class="p-4 border-t border-blue-700/50 bg-blue-900/30 backdrop-blur-sm">
        <div class="flex items-center mb-4 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg mr-3">
                <span class="font-bold text-white">{{ substr(Auth::user()->karyawan->nama, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-white truncate">{{ Auth::user()->karyawan->nama }}</p>
                <p class="text-xs text-blue-300 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-red-600/20 hover:shadow-lg group">
                <div
                    class="w-8 h-8 bg-red-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-500 transition-colors">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                </div>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>
