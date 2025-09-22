<x-layout.dashboard title="Edit Upah Lembur">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Upah Lembur
                    </h1>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('upah.update', $upah) }}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Catatan Lembur -->
                    <div>
                        <label for="catatan_lembur_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Lembur <span class="text-red-500">*</span>
                        </label>
                        <select id="catatan_lembur_id" name="catatan_lembur_id"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @if ($errors->has('catatan_lembur_id')) border-red-500 @else @endif"
                            onchange="updatePreview()">
                            <option value="">Pilih Catatan Lembur</option>
                            @foreach ($catatanLemburs as $catatanLembur)
                                <option value="{{ $catatanLembur->id }}"
                                    {{ old('catatan_lembur_id', $upah->catatan_lembur_id) == $catatanLembur->id ? 'selected' : '' }}
                                    data-durasi="{{ $catatanLembur->durasi_lembur }}"
                                    data-karyawan="{{ $catatanLembur->karyawan->nama }}"
                                    data-tanggal="{{ $catatanLembur->tanggal->format('d M Y') }}"
                                    data-jam="{{ $catatanLembur->jam_masuk->format('H:i') }} - {{ $catatanLembur->jam_keluar->format('H:i') }}">
                                    {{ $catatanLembur->tanggal->format('d M Y') }} -
                                    {{ $catatanLembur->karyawan->nama }} ({{ $catatanLembur->durasi_lembur }} jam)
                                </option>
                            @endforeach
                        </select>
                        @error('catatan_lembur_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Upah Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3">Informasi Upah Saat Ini</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-600">Karyawan:</span>
                                <span class="text-gray-900">{{ $upah->catatanLembur->karyawan->nama }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Durasi:</span>
                                <span class="text-gray-900">{{ $upah->catatanLembur->durasi_lembur }} jam</span>
                            </div>
                            <div class="col-span-2">
                                <span class="font-medium text-gray-600">Upah Saat Ini:</span>
                                <span class="text-lg font-bold text-green-600">{{ $upah->formatted_jumlah }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Perhitungan -->
                    <div id="preview" class="bg-gray-50 p-4 rounded-lg" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Preview Perhitungan Upah Baru</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-600">Karyawan:</span>
                                <span id="preview-karyawan" class="text-gray-900"></span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Tanggal:</span>
                                <span id="preview-tanggal" class="text-gray-900"></span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Jam Lembur:</span>
                                <span id="preview-jam" class="text-gray-900"></span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Durasi:</span>
                                <span id="preview-durasi" class="text-gray-900"></span>
                            </div>
                            <div class="col-span-2 border-t pt-2">
                                <span class="font-medium text-gray-600">Total Upah Baru:</span>
                                <span id="preview-upah" class="text-lg font-bold text-green-600"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <x-ui.button variant="outline" size="lg" onclick="history.back()"
                            class="border-gray-300 text-gray-700 hover:bg-gray-50">
                            Batal
                        </x-ui.button>
                        <x-ui.button type="submit" variant="primary" size="lg" icon="fas fa-save">
                            Update Upah
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updatePreview() {
            const select = document.getElementById('catatan_lembur_id');
            const preview = document.getElementById('preview');
            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                const durasi = parseFloat(selectedOption.getAttribute('data-durasi')) || 0;
                const tarifPerJam = 50000; // Sesuaikan dengan tarif per jam
                const totalUpah = durasi * tarifPerJam;

                document.getElementById('preview-karyawan').textContent = selectedOption.getAttribute('data-karyawan');
                document.getElementById('preview-tanggal').textContent = selectedOption.getAttribute('data-tanggal');
                document.getElementById('preview-jam').textContent = selectedOption.getAttribute('data-jam');
                document.getElementById('preview-durasi').textContent = durasi + ' jam';
                document.getElementById('preview-upah').textContent = 'Rp ' + totalUpah.toLocaleString('id-ID');

                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();
        });
    </script>
</x-layout.dashboard>
