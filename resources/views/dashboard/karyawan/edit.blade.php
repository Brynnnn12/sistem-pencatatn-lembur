<x-layout.dashboard title="Edit Karyawan">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-teal-600 to-teal-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Karyawan
                    </h1>
                </div>

                <!-- Form -->
                <form action="{{ route('karyawan.update', $karyawan) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- User Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Akun</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="nik" id="nik"
                                value="{{ old('nik', $karyawan->user->nik) }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('nik')) border-red-500 @endif"
                                required>
                            @error('nik')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $karyawan->user->email) }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('email')) border-red-500 @endif"
                                required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password Baru (Opsional)
                            </label>
                            <input type="password" name="password" id="password"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('password')) border-red-500 @endif">
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                        </div>
                    </div>

                    <!-- Employee Information -->
                    <div class="pt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Karyawan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Karyawan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $karyawan->nama) }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('nama')) border-red-500 @endif"
                                required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $karyawan->phone) }}"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('phone')) border-red-500 @endif"
                                placeholder="Contoh: 6281234567890">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="departemen_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Departemen <span class="text-red-500">*</span>
                            </label>
                            <select name="departemen_id" id="departemen_id"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('departemen_id')) border-red-500 @endif"
                                required>
                                <option value="">Pilih Departemen</option>
                                @foreach ($departemens as $departemen)
                                    <option value="{{ $departemen->id }}"
                                        {{ old('departemen_id', $karyawan->departemen_id) == $departemen->id ? 'selected' : '' }}>
                                        {{ $departemen->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departemen_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="jabatan_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Jabatan <span class="text-red-500">*</span>
                            </label>
                            <select name="jabatan_id" id="jabatan_id"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @if ($errors->has('jabatan_id')) border-red-500 @endif"
                                required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}"
                                        {{ old('jabatan_id', $karyawan->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
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
                        <x-ui.button variant="primary" type="submit" size="lg" icon="fas fa-save">
                            Update Karyawan
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.dashboard>
