<x-layout.dashboard title="Jabatan">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Jabatan</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('jabatan.create') }}'">
                Tambah Jabatan
            </x-ui.button>
        </x-slot>


        <!-- Jabatan Table -->
        <x-table.table :headers="['No', 'Nama', 'Aksi']" striped hover>
            @forelse($jabatans as $jabatan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $jabatan->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                onclick="location.href='{{ route('jabatan.edit', $jabatan) }}'">
                                Edit
                            </x-ui.button>
                            <form action="{{ route('jabatan.destroy', $jabatan) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-ui.button size="xs" variant="danger" icon="fas fa-trash" type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
                                    Delete
                                </x-ui.button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-briefcase text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada jabatan</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat jabatan pertama Anda</p>
                            <x-ui.button variant="primary" icon="fas fa-plus"
                                onclick="location.href='{{ route('jabatan.create') }}'">
                                Buat Jabatan Pertama
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $jabatans->links('vendor.pagination.tailwind') }}
        </div>
    </x-ui.card>

</x-layout.dashboard>
