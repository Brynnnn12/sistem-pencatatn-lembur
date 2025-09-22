<x-layout.dashboard title="Detail Karyawan">
    <div class="container mx-auto px-4 py-8">
        @if (auth()->user()->hasRole('Karyawan'))
            <!-- Special Layout for Karyawan Role -->
            <div class="max-w-6xl mx-auto space-y-6">
                <!-- Profile Card -->
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 px-8 py-12">
                        <div
                            class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-user text-4xl text-blue-600"></i>
                            </div>
                            <div class="text-center md:text-left text-white">
                                <h1 class="text-4xl font-bold mb-2">{{ $karyawan->nama }}</h1>
                                <p class="text-xl text-blue-100 mb-4">{{ $karyawan->jabatan->name }} -
                                    {{ $karyawan->departemen->name }}</p>
                                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                                    @foreach ($karyawan->user->roles as $role)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="px-8 py-6 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Total Disetujui</p>
                                        <p class="text-2xl font-bold text-blue-700">{{ $totalDisetujui ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-clock text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Total Lembur</p>
                                        <p class="text-2xl font-bold text-green-700">{{ $totalLembur ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Total Upah</p>
                                        <p class="text-2xl font-bold text-purple-700">Rp
                                            {{ number_format($totalUpah ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Account Information Card -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                Informasi Akun
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                                <span class="font-semibold text-gray-800">{{ $karyawan->user->name }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Email:</span>
                                <span class="font-semibold text-gray-800">{{ $karyawan->user->email }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Bergabung:</span>
                                <span
                                    class="font-semibold text-gray-800">{{ $karyawan->user->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Information Card -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <i class="fas fa-id-card mr-2"></i>
                                Informasi Karyawan
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Nama Karyawan:</span>
                                <span class="font-semibold text-gray-800">{{ $karyawan->nama }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Departemen:</span>
                                <span class="font-semibold text-gray-800">{{ $karyawan->departemen->name }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Jabatan:</span>
                                <span class="font-semibold text-gray-800">{{ $karyawan->jabatan->name }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-600 font-medium">ID Karyawan:</span>
                                <span class="font-semibold text-gray-800">#{{ $karyawan->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <x-ui.button variant="outline" size="lg" icon="fas fa-arrow-left" onclick="history.back()"
                        class="bg-white hover:bg-gray-50 border-2">
                        Kembali ke Daftar
                    </x-ui.button>
                </div>
            </div>
        @else
            <!-- Standard Layout for Other Roles -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-white">{{ $karyawan->nama }}</h1>
                                <p class="text-blue-100">{{ $karyawan->user->email }}</p>
                            </div>
                            <div class="flex space-x-2">
                                @can('update', $karyawan)
                                    <x-ui.button variant="outline" size="sm" icon="fas fa-edit"
                                        onclick="location.href='{{ route('karyawan.edit', $karyawan) }}'"
                                        class="bg-white text-blue-600 border-white hover:bg-blue-50">
                                        Edit
                                    </x-ui.button>
                                @endcan
                                <x-ui.button variant="outline" size="sm" icon="fas fa-arrow-left"
                                    onclick="history.back()"
                                    class="bg-white text-blue-600 border-white hover:bg-blue-50">
                                    Kembali
                                </x-ui.button>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Account Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    Informasi Akun
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama Lengkap:</span>
                                        <span class="font-medium">{{ $karyawan->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Email:</span>
                                        <span class="font-medium">{{ $karyawan->user->email }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Role:</span>
                                        <span class="font-medium">
                                            @foreach ($karyawan->user->roles as $role)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Bergabung:</span>
                                        <span
                                            class="font-medium">{{ $karyawan->user->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-id-card mr-2 text-green-600"></i>
                                    Informasi Karyawan
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama Karyawan:</span>
                                        <span class="font-medium">{{ $karyawan->nama }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Departemen:</span>
                                        <span class="font-medium">{{ $karyawan->departemen->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jabatan:</span>
                                        <span class="font-medium">{{ $karyawan->jabatan->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">ID Karyawan:</span>
                                        <span class="font-medium">#{{ $karyawan->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Summary -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-chart-line mr-2 text-purple-600"></i>
                                Ringkasan Aktivitas
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-calendar-check text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Total Disetujui</p>
                                            <p class="text-xl font-bold text-blue-700">{{ $totalDisetujui ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-clock text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Total Lembur</p>
                                            <p class="text-xl font-bold text-green-700">{{ $totalLembur ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-money-bill-wave text-purple-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Total Upah</p>
                                            <p class="text-xl font-bold text-purple-700">Rp
                                                {{ number_format($totalUpah ?? 0, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout.dashboard>
