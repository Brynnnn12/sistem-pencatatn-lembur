<x-layout.dashboard title="Detail Persetujuan Lembur">
    <div class="container mx-auto px-4 py-8">
        @if (auth()->user()->hasRole('Karyawan'))
            <!-- Special Layout for Karyawan Role -->
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Header Card -->
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <div
                        class="bg-gradient-to-br from-{{ $persetujuan->status_color }}-500 via-{{ $persetujuan->status_color }}-600 to-{{ $persetujuan->status_color }}-700 px-8 py-8">
                        <div class="text-center text-white">
                            <div
                                class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <i
                                    class="{{ $persetujuan->status_icon }} text-3xl text-{{ $persetujuan->status_color }}-600"></i>
                            </div>
                            <h1 class="text-3xl font-bold mb-2">Status Persetujuan</h1>
                            <p class="text-xl text-{{ $persetujuan->status_color }}-100">
                                {{ ucfirst($persetujuan->status) }}</p>
                        </div>
                    </div>

                    <!-- Persetujuan Information -->
                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Catatan Lembur
                                </h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Tanggal: <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->tanggal->format('l, d F Y') }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600">Jam: <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->jam_masuk_formatted }}
                                            - {{ $persetujuan->catatanLembur->jam_keluar_formatted }}</span></p>
                                    <p class="text-sm text-gray-600">Durasi: <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->durasi_lembur }}
                                            jam</span></p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-xl">
                                <h3 class="text-lg font-semibold text-green-800 mb-4 flex items-center">
                                    <i class="fas fa-user-check mr-2"></i>
                                    Approver
                                </h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Nama: <span
                                            class="font-medium">{{ $persetujuan->user ? $persetujuan->user->name : 'Belum ditentukan' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600">Email: <span
                                            class="font-medium">{{ $persetujuan->user ? $persetujuan->user->email : '-' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600">Tanggal: <span
                                            class="font-medium">{{ $persetujuan->created_at->format('d M Y H:i') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Karyawan Information Card -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Informasi Karyawan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Nama Karyawan:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $persetujuan->catatanLembur->karyawan->nama }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Jabatan:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $persetujuan->catatanLembur->karyawan->jabatan->name }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">Departemen:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $persetujuan->catatanLembur->karyawan->departemen->name }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                    <span class="text-gray-600 font-medium">ID Karyawan:</span>
                                    <span
                                        class="font-semibold text-gray-800">#{{ $persetujuan->catatanLembur->karyawan->id }}</span>
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
                    <div
                        class="bg-gradient-to-r from-{{ $persetujuan->status_color }}-600 to-{{ $persetujuan->status_color }}-800 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-white">Detail Persetujuan Lembur</h1>
                                <p class="text-{{ $persetujuan->status_color }}-100">
                                    {{ ucfirst($persetujuan->status) }}</p>
                            </div>
                            <div class="flex space-x-2">
                                @can('update', $persetujuan)
                                    <x-ui.button variant="outline" size="sm" icon="fas fa-edit"
                                        onclick="location.href='{{ route('persetujuan.edit', $persetujuan) }}'"
                                        class="bg-white text-{{ $persetujuan->status_color }}-600 border-white hover:bg-{{ $persetujuan->status_color }}-50">
                                        Edit
                                    </x-ui.button>
                                @endcan
                                <x-ui.button variant="outline" size="sm" icon="fas fa-arrow-left"
                                    onclick="history.back()"
                                    class="bg-white text-{{ $persetujuan->status_color }}-600 border-white hover:bg-{{ $persetujuan->status_color }}-50">
                                    Kembali
                                </x-ui.button>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Catatan Lembur Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-clock mr-2 text-blue-600"></i>
                                    Catatan Lembur
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tanggal:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->tanggal->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jam Masuk:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->jam_masuk_formatted }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jam Keluar:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->catatanLembur->jam_keluar_formatted }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Durasi:</span>
                                        <span class="font-medium">{{ $persetujuan->catatanLembur->durasi_lembur }}
                                            jam</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Persetujuan Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i
                                        class="{{ $persetujuan->status_icon }} mr-2 text-{{ $persetujuan->status_color }}-600"></i>
                                    Informasi Persetujuan
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="font-medium">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $persetujuan->status_color }}-100 text-{{ $persetujuan->status_color }}-800">
                                                <i class="{{ $persetujuan->status_icon }} mr-1"></i>
                                                {{ ucfirst($persetujuan->status) }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Approver:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->user ? $persetujuan->user->name : 'Belum ditentukan' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Email:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->user ? $persetujuan->user->email : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tanggal Persetujuan:</span>
                                        <span
                                            class="font-medium">{{ $persetujuan->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Karyawan Information -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-user mr-2 text-green-600"></i>
                                Informasi Karyawan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama Karyawan:</span>
                                    <span class="font-medium">{{ $persetujuan->catatanLembur->karyawan->nama }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Departemen:</span>
                                    <span
                                        class="font-medium">{{ $persetujuan->catatanLembur->karyawan->departemen->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jabatan:</span>
                                    <span
                                        class="font-medium">{{ $persetujuan->catatanLembur->karyawan->jabatan->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ID Karyawan:</span>
                                    <span class="font-medium">#{{ $persetujuan->catatanLembur->karyawan->id }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t">
                            @can('delete', $persetujuan)
                                <form method="POST" action="{{ route('persetujuan.destroy', $persetujuan) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus persetujuan ini?')"
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
