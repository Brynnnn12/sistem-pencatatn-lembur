<x-layout.dashboard title="Tambah Catatan Lembur">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-600 to-orange-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Catatan Lembur
                    </h1>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('catatan-lembur.store') }}" class="p-6 space-y-6">
                    @csrf

                    @if (!auth()->user()->hasRole('Karyawan'))
                        <!-- Karyawan -->
                        <div>
                            <label for="karyawan_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Karyawan <span class="text-red-500">*</span>
                            </label>
                            <select name="karyawan_id" id="karyawan_id"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @if ($errors->has('karyawan_id')) border-red-500 @endif"
                                required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}"
                                        {{ old('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama }} - {{ $karyawan->jabatan->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('karyawan_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Tanggal Lembur -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lembur <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @if ($errors->has('tanggal')) border-red-500 @endif"
                            required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Masuk & Keluar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_masuk" class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Masuk (WIB, format 24 jam) <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_masuk" id="jam_masuk" value="{{ old('jam_masuk') }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @if ($errors->has('jam_masuk')) border-red-500 @endif"
                                placeholder="HH:MM" required>
                            @error('jam_masuk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jam_keluar" class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Keluar (WIB, format 24 jam) <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_keluar" id="jam_keluar" value="{{ old('jam_keluar') }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @if ($errors->has('jam_keluar')) border-red-500 @endif"
                                placeholder="HH:MM" required>
                            @error('jam_keluar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <x-ui.button variant="outline" size="lg" onclick="history.back()"
                            class="border-gray-300 text-gray-700 hover:bg-gray-50">
                            Batal
                        </x-ui.button>
                        <x-ui.button type="submit" variant="primary" size="lg" icon="fas fa-save">
                            Simpan Catatan Lembur
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.dashboard>
