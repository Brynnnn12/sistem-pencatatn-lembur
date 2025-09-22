<x-layout.dashboard title="Tambah Departemen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Departemen
                    </h1>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('departemen.store') }}" class="p-6 space-y-6">
                    @csrf

                    <!-- Nama Departemen -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Departemen <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 @if ($errors->has('name')) border-red-500 @endif"
                            required>
                        @error('name')
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
                            Simpan Departemen
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.dashboard>
