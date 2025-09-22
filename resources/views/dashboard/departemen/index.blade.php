<x-layout.dashboard title="Manajemen Departemen">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Departemen</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('departemen.create') }}'">
                Tambah Departemen
            </x-ui.button>
        </x-slot>


        <!-- Departemen Table -->
        <x-table.table :headers="['No', 'Nama', 'Aksi']" striped hover>
            @forelse($departemen as $dept)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $dept->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                onclick="location.href='{{ route('departemen.edit', $dept) }}'">
                                Edit
                            </x-ui.button>
                            <form action="{{ route('departemen.destroy', $dept) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-ui.button size="xs" variant="danger" icon="fas fa-trash" type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus departemen ini?')">
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
                            <i class="fas fa-building text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada departemen</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat departemen pertama Anda</p>
                            <x-ui.button variant="primary" icon="fas fa-plus"
                                onclick="location.href='{{ route('departemen.create') }}'">
                                Buat Departemen Pertama
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $departemen->links('vendor.pagination.tailwind') }}
        </div>
    </x-ui.card>

</x-layout.dashboard>
