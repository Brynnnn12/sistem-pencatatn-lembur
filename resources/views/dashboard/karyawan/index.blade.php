<x-layout.dashboard title="Manajemen Karyawan">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Karyawan</h3>
            @can('create', App\Models\Karyawan::class)
                <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('karyawan.create') }}'">
                    Tambah Karyawan
                </x-ui.button>
            @endcan
        </x-slot>


        <!-- Karyawan Table -->
        <x-table.table :headers="['No', 'Nama', 'Email', 'Departemen', 'Jabatan', 'Aksi']" striped hover>
            @forelse($karyawans as $karyawan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $karyawan->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $karyawan->user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $karyawan->departemen->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $karyawan->jabatan->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                onclick="location.href='{{ route('karyawan.show', $karyawan) }}'">
                                View
                            </x-ui.button>
                            @can('update', $karyawan)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                    onclick="location.href='{{ route('karyawan.edit', $karyawan) }}'">
                                    Edit
                                </x-ui.button>
                            @endcan
                            @can('delete', $karyawan)
                                <form action="{{ route('karyawan.destroy', $karyawan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button size="xs" variant="danger" icon="fas fa-trash" type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                        Delete
                                    </x-ui.button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada karyawan</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat karyawan pertama Anda</p>
                            @can('create', App\Models\Karyawan::class)
                                <x-ui.button variant="primary" icon="fas fa-plus"
                                    onclick="location.href='{{ route('karyawan.create') }}'">
                                    Buat Karyawan Pertama
                                </x-ui.button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $karyawans->links('vendor.pagination.tailwind') }}
        </div>
    </x-ui.card>

</x-layout.dashboard>
