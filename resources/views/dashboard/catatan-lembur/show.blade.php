<x-layout.dashboard title="Detail Catatan Lembur">
    <div class="container mx-auto px-4 py-8">
        @if (auth()->user()->hasRole('Karyawan'))
            <!-- Special Layout for Karyawan Role -->
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Header Card -->
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 px-8 py-8">
                        <div class="text-center text-white">
                            <div
                                class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <i class="fas fa-calendar-check text-3xl text-blue-600"></i>
                            </div>
                            <h1 class="text-3xl font-bold mb-2">Detail Lembur</h1>
                            <p class="text-xl text-blue-100">{{ $catatanLembur->tanggal->format('l, d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Time Information -->
                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl text-center">
                                <i class="fas fa-sign-in-alt text-2xl text-blue-600 mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Jam Masuk</p>
                                <p class="text-3xl font-bold text-blue-700">
                                    {{ $catatanLembur->jam_masuk_formatted }}</p>
                            </div>
                            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-xl text-center">
                                <i class="fas fa-sign-out-alt text-2xl text-green-600 mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Jam Keluar</p>
                                <p class="text-3xl font-bold text-green-700">
                                    {{ $catatanLembur->jam_keluar_formatted }}</p>
                            </div>
                            <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-xl text-center">
                                <i class="fas fa-clock text-2xl text-purple-600 mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Durasi Lembur</p>
                                <p class="text-3xl font-bold text-purple-700">{{ $catatanLembur->durasi_lembur }} jam
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Information Card -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Informasi Karyawan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Nama Karyawan:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $catatanLembur->karyawan->nama }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Jabatan:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $catatanLembur->karyawan->jabatan->name }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Departemen:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $catatanLembur->karyawan->departemen->name }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">ID Karyawan:</span>
                                    <span class="font-semibold text-gray-800">#{{ $catatanLembur->karyawan->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center">
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
                                <h1 class="text-2xl font-bold text-white">Detail Catatan Lembur</h1>
                                <p class="text-blue-100">{{ $catatanLembur->karyawan->nama }}</p>
                            </div>
                            <div class="flex space-x-2">
                                @can('update', $catatanLembur)
                                    <x-ui.button variant="outline" size="sm" icon="fas fa-edit"
                                        onclick="location.href='{{ route('catatan-lembur.edit', $catatanLembur) }}'"
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
                            <!-- Employee Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    Informasi Karyawan
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama Karyawan:</span>
                                        <span class="font-medium">{{ $catatanLembur->karyawan->nama }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Departemen:</span>
                                        <span
                                            class="font-medium">{{ $catatanLembur->karyawan->departemen->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jabatan:</span>
                                        <span class="font-medium">{{ $catatanLembur->karyawan->jabatan->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">ID Karyawan:</span>
                                        <span class="font-medium">#{{ $catatanLembur->karyawan->id }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Overtime Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-clock mr-2 text-green-600"></i>
                                    Informasi Lembur
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tanggal:</span>
                                        <span class="font-medium">{{ $catatanLembur->tanggal->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jam Masuk:</span>
                                        <span class="font-medium">{{ $catatanLembur->jam_masuk_formatted }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jam Keluar:</span>
                                        <span class="font-medium">{{ $catatanLembur->jam_keluar_formatted }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Durasi Lembur:</span>
                                        <span class="text-green-600 font-semibold">{{ $catatanLembur->durasi_lembur }}
                                            jam</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t">
                            @can('delete', $catatanLembur)
                                <form method="POST" action="{{ route('catatan-lembur.destroy', $catatanLembur) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan lembur ini?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button type="submit" variant="outline" size="sm" icon="fas fa-trash"
                                        class="text-red-600 border-red-600 hover:bg-red-50">
                                        Hapus
                                    </x-ui.button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout.dashboard>
