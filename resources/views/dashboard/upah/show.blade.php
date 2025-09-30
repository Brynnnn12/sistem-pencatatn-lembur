<x-layout.dashboard title="Detail Upah Lembur">
    <div class="container mx-auto px-4 py-8">
        @if (auth()->user()->hasRole('Karyawan'))
            <!-- Special Layout for Karyawan Role -->
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Header Card -->
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 px-8 py-8">
                        <div class="text-center text-white">
                            <div
                                class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <i class="fas fa-money-bill-wave text-3xl text-green-600"></i>
                            </div>
                            <h1 class="text-3xl font-bold mb-2">Upah Lembur</h1>
                            <p class="text-xl text-green-100">{{ $upah->formatted_jumlah }}</p>
                        </div>
                    </div>

                    <!-- Upah Information -->
                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Catatan Lembur
                                </h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Tanggal: <span
                                            class="font-medium">{{ $upah->catatanLembur->tanggal->translatedFormat('l, d F Y') }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600">Jam: <span
                                            class="font-medium">{{ $upah->catatanLembur->jam_masuk_formatted }} -
                                            {{ $upah->catatanLembur->jam_keluar_formatted }}</span></p>
                                    <p class="text-sm text-gray-600">Durasi: <span
                                            class="font-medium">{{ $upah->catatanLembur->durasi_lembur }} jam</span></p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-xl">
                                <h3 class="text-lg font-semibold text-purple-800 mb-4 flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    Karyawan
                                </h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Nama: <span
                                            class="font-medium">{{ $upah->catatanLembur->karyawan->nama }}</span></p>
                                    <p class="text-sm text-gray-600">Jabatan: <span
                                            class="font-medium">{{ $upah->catatanLembur->karyawan->jabatan->name }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600">Departemen: <span
                                            class="font-medium">{{ $upah->catatanLembur->karyawan->departemen->name }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Perhitungan Detail -->
                        <div class="mt-6 bg-gradient-to-r from-yellow-50 to-yellow-100 p-6 rounded-xl">
                            <h3 class="text-lg font-semibold text-yellow-800 mb-4 flex items-center">
                                <i class="fas fa-calculator mr-2"></i>
                                Detail Perhitungan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-800">
                                        {{ $upah->catatanLembur->durasi_lembur }}</p>
                                    <p class="text-sm text-gray-600">Jam Lembur</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-800">Rp 20.000</p>
                                    <p class="text-sm text-gray-600">Tarif per Jam</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-green-600">{{ $upah->formatted_jumlah }}</p>
                                    <p class="text-sm text-gray-600">Total Upah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <x-ui.button variant="outline" size="lg" onclick="history.back()"
                        class="border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </x-ui.button>
                </div>
            </div>
        @else
            <!-- Standard Layout for Pimpinan/HRD -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-green-600 to-green-800 px-8 py-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-3xl font-bold text-white">Detail Upah Lembur</h1>
                                <p class="text-green-100 mt-1">Informasi lengkap upah lembur</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-white">{{ $upah->formatted_jumlah }}</div>
                                <div class="text-green-100">Total Upah</div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Catatan Lembur Info -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
                                        Catatan Lembur
                                    </h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tanggal:</span>
                                            <span
                                                class="font-medium">{{ $upah->catatanLembur->tanggal->format('l, d F Y') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jam Masuk:</span>
                                            <span
                                                class="font-medium">{{ $upah->catatanLembur->jam_masuk_formatted }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jam Keluar:</span>
                                            <span
                                                class="font-medium">{{ $upah->catatanLembur->jam_keluar_formatted }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Durasi:</span>
                                            <span class="font-medium">{{ $upah->catatanLembur->durasi_lembur }}
                                                jam</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Karyawan Info -->
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-user text-green-600 mr-2"></i>
                                        Karyawan
                                    </h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Nama:</span>
                                            <span class="font-medium">{{ $upah->catatanLembur->karyawan->nama }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jabatan:</span>
                                            <span
                                                class="font-medium">{{ $upah->catatanLembur->karyawan->jabatan->name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Departemen:</span>
                                            <span
                                                class="font-medium">{{ $upah->catatanLembur->karyawan->departemen->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Perhitungan & Actions -->
                            <div class="space-y-6">
                                <!-- Perhitungan Detail -->
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-calculator text-green-600 mr-2"></i>
                                        Perhitungan Upah
                                    </h3>
                                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-6">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700">Durasi Lembur:</span>
                                                <span class="font-semibold">{{ $upah->catatanLembur->durasi_lembur }}
                                                    jam</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700">Tarif per Jam:</span>
                                                <span class="font-semibold">Rp 20.000</span>
                                            </div>
                                            <hr class="border-green-200">
                                            <div class="flex justify-between items-center text-lg">
                                                <span class="font-semibold text-gray-800">Total Upah:</span>
                                                <span
                                                    class="font-bold text-green-600 text-xl">{{ $upah->formatted_jumlah }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Metadata -->
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-info-circle text-green-600 mr-2"></i>
                                        Informasi
                                    </h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Dibuat:</span>
                                            <span
                                                class="font-medium">{{ $upah->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Terakhir Update:</span>
                                            <span
                                                class="font-medium">{{ $upah->updated_at->format('d M Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 mt-8 pt-8 border-t">
                            <x-ui.button variant="outline" size="lg" onclick="history.back()"
                                class="border-gray-300 text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </x-ui.button>
                            @can('delete', $upah)
                                <form method="POST" action="{{ route('upah.destroy', $upah) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus upah ini?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button type="submit" variant="outline" size="lg" icon="fas fa-trash"
                                        class="border-red-500 text-red-600 hover:bg-red-50">
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
