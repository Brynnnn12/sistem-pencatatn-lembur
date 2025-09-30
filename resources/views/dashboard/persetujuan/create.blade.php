<x-layout.dashboard title="Tambah Persetujuan">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Persetujuan
                    </h1>
                </div>

                <!-- Form -->
                <form action="{{ route('persetujuan.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Catatan Lembur -->
                    <div>
                        <label for="catatan_lembur_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Lembur <span class="text-red-500">*</span>
                        </label>
                        <select id="catatan_lembur_id" name="catatan_lembur_id"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @if ($errors->has('catatan_lembur_id')) border-red-500 @endif"
                            required>
                            <option value="">Pilih Catatan Lembur</option>
                            @foreach ($catatanLemburs as $catatanLembur)
                                <option value="{{ $catatanLembur->id }}"
                                    {{ old('catatan_lembur_id') == $catatanLembur->id ? 'selected' : '' }}>
                                    {{ $catatanLembur->tanggal->format('d M Y') }} -
                                    {{ $catatanLembur->karyawan->nama }} ({{ $catatanLembur->jam_masuk_formatted }}
                                    - {{ $catatanLembur->jam_keluar_formatted }})
                                </option>
                            @endforeach
                        </select>
                        @error('catatan_lembur_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Disetujui Oleh -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Disetujui Oleh <span class="text-red-500">*</span>
                        </label>
                        <select id="user_id" name="user_id"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @if ($errors->has('user_id')) border-red-500 @endif"
                            required>
                            <option value="">Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Persetujuan -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Persetujuan <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @if ($errors->has('status')) border-red-500 @endif"
                            required>
                            <option value="">Pilih Status</option>
                            <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <x-ui.button variant="outline" size="lg" onclick="history.back()"
                            class="border-gray-300 text-gray-700 hover:bg-gray-50">
                            Batal
                        </x-ui.button>
                        <x-ui.button type="submit" variant="primary" size="lg" icon="fas fa-save">
                            Simpan Persetujuan
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.dashboard>
