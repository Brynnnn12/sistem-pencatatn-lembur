<!-- Mobile Sidebar -->
<div x-show="isSidebarOpen" @click.away="isSidebarOpen = false" class="fixed inset-0 z-50 md:hidden" x-cloak>
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 backdrop-blur-sm" @click="isSidebarOpen = false"></div>
    <div x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-72 max-w-[85vw] bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 text-white flex flex-col shadow-2xl">
    </div>
    <span class="font-medium">Ajukan Lembur</span>
    </a>ition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 md:hidden" x-cloak>
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 backdrop-blur-sm" @click="isSidebarOpen = false"></div>
    <div x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-72 max-w-[85vw] bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 text-white flex flex-col shadow-2xl">
        <!-- Header -->
        <div
            class="flex items-center justify-between py-6 px-4 border-b border-blue-700/50 bg-blue-900/50 backdrop-blur-sm">
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
            <button @click="isSidebarOpen = false"
                class="text-white hover:text-blue-300 transition-all duration-200 hover:scale-110 p-2 rounded-lg hover:bg-white/10">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-800/30 px-2">
            <nav class="py-6 space-y-1">
                <!-- Overview -->
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                    @click="isSidebarOpen = false">
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

                        @if (Auth::user()->hasRole('Pimpinan'))
                            <a href="{{ route('jabatan.index') }}"
                                class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('jabatan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                                @click="isSidebarOpen = false">
                                <div
                                    class="w-8 h-8 bg-purple-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-500 transition-all duration-300 group-hover:rotate-12">
                                    <i class="fas fa-briefcase text-sm"></i>
                                </div>
                                <span class="font-medium">Jabatan</span>
                            </a>

                            <a href="{{ route('departemen.index') }}"
                                class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('departemen.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                                @click="isSidebarOpen = false">
                                <div
                                    class="w-8 h-8 bg-green-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-500 transition-all duration-300 group-hover:rotate-12">
                                    <i class="fas fa-building text-sm"></i>
                                </div>
                                <span class="font-medium">Departemen</span>
                            </a>
                        @endif
                        <a href="{{ route('karyawan.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('karyawan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
                            <div
                                class="w-8 h-8 bg-indigo-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-indigo-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-users text-sm"></i>
                            </div>
                            <span class="font-medium">Karyawan</span>
                        </a>
                        <a href="{{ route('catatan-lembur.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('catatan-lembur.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
                            <div
                                class="w-8 h-8 bg-yellow-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-clock text-sm"></i>
                            </div>
                            <span class="font-medium">Catatan Lembur</span>
                        </a>

                        <a href="{{ route('persetujuan.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('persetujuan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
                            <div
                                class="w-8 h-8 bg-emerald-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-emerald-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-check-circle text-sm"></i>
                            </div>
                            <span class="font-medium">Persetujuan</span>
                        </a>

                        <a href="{{ route('upah.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('upah.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
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
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-105 {{ request()->routeIs('catatan-lembur.create') ? 'bg-white/20 shadow-lg scale-105' : '' }}"
                            @click="isSidebarOpen = false">
                            <div
                                class="w-8 h-8 bg-yellow-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-500 transition-colors">
                                <i class="fas fa-plus text-sm"></i>
                            </div>
                            <span class="font-medium">Ajukan Lembur</span>
                        </a>

                        <a href="{{ route('persetujuan.index') }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('persetujuan.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
                            <div
                                class="w-8 h-8 bg-emerald-600/50 rounded-lg flex items-center justify-center mr-3 group-hover:bg-emerald-500 transition-all duration-300 group-hover:rotate-12">
                                <i class="fas fa-check-circle text-sm"></i>
                            </div>
                            <span class="font-medium">Status Persetujuan</span>
                        </a>

                        <a href="{{ route('karyawan.show', Auth::user()->karyawan->id) }}"
                            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('karyawan.show') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                            @click="isSidebarOpen = false">
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
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:scale-[1.02] hover:translate-x-1 {{ request()->routeIs('profile.*') ? 'bg-white/20 shadow-lg scale-[1.02] translate-x-1' : '' }}"
                        @click="isSidebarOpen = false">
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
                    <span class="font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-white truncate">{{ Auth::user()->name }}</p>
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
</div>
