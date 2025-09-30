<x-layout.dashboard title="Catatan Lembur">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">
                @if (auth()->user()->hasRole('Karyawan'))
                    Catatan Lembur Saya
                @else
                    Manajemen Catatan Lembur
                @endif
            </h3>
            @can('create', App\Models\CatatanLembur::class)
                <x-ui.button variant="primary" icon="fas fa-plus"
                    onclick="location.href='{{ route('catatan-lembur.create') }}'">
                    Tambah
                </x-ui.button>
            @endcan
        </x-slot>

        <!-- Catatan Lembur Table -->
        <x-table.table :headers="auth()->user()->hasRole('Karyawan')
            ? ['No', 'Tanggal', 'Jam Masuk', 'Jam Keluar', 'Durasi', 'Aksi']
            : ['No', 'Karyawan', 'Tanggal', 'Jam Masuk', 'Jam Keluar', 'Durasi', 'Aksi']" striped hover>
            @forelse($catatanLemburs as $catatanLembur)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    @if (!auth()->user()->hasRole('Karyawan'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $catatanLembur->karyawan->nama }}
                            <div class="text-sm text-gray-500">{{ $catatanLembur->karyawan->jabatan->name }}</div>
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $catatanLembur->tanggal->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $catatanLembur->jam_masuk_formatted }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $catatanLembur->jam_keluar_formatted }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $catatanLembur->durasi_lembur }} jam
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            @can('view', $catatanLembur)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                    onclick="location.href='{{ route('catatan-lembur.show', $catatanLembur) }}'">
                                    View
                                </x-ui.button>
                            @endcan
                            @can('update', $catatanLembur)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                    onclick="location.href='{{ route('catatan-lembur.edit', $catatanLembur) }}'">
                                    Edit
                                </x-ui.button>
                            @endcan
                            @can('delete', $catatanLembur)
                                <form action="{{ route('catatan-lembur.destroy', $catatanLembur) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button size="xs" variant="danger" icon="fas fa-trash" type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus catatan lembur ini?')">
                                        Delete
                                    </x-ui.button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->hasRole('Karyawan') ? 6 : 7 }}" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada catatan lembur</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat catatan lembur pertama Anda</p>
                            @can('create', App\Models\CatatanLembur::class)
                                <x-ui.button variant="primary" icon="fas fa-plus"
                                    onclick="location.href='{{ route('catatan-lembur.create') }}'">
                                    Buat Catatan Lembur Pertama
                                </x-ui.button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        @if ($catatanLemburs->hasPages())
            <div class="mt-4">
                {{ $catatanLemburs->links() }}
            </div>
        @endif
    </x-ui.card>
</x-layout.dashboard>
