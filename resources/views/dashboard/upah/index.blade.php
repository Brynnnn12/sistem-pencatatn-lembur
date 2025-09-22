<x-layout.dashboard title="Upah Lembur">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Upah Lembur</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola data upah catatan lembur</p>
        </x-slot>

        <!-- Upah Table -->
        <x-table.table :headers="['Catatan Lembur', 'Karyawan', 'Durasi Lembur', 'Jumlah Upah', 'Tanggal Dibuat', 'Aksi']" striped hover>
            @forelse ($upahs as $upah)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $upah->catatanLembur->tanggal->format('d M Y') }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $upah->catatanLembur->jam_masuk->format('H:i') }} -
                            {{ $upah->catatanLembur->jam_keluar->format('H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $upah->catatanLembur->karyawan->nama }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $upah->catatanLembur->karyawan->jabatan->name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $upah->catatanLembur->durasi_lembur }} jam
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-lg font-semibold text-green-600">
                            {{ $upah->formatted_jumlah }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $upah->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            @can('view', $upah)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                    onclick="location.href='{{ route('upah.show', $upah) }}'">
                                    Lihat
                                </x-ui.button>
                            @endcan
                            @can('update', $upah)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                    onclick="location.href='{{ route('upah.edit', $upah) }}'">
                                    Edit
                                </x-ui.button>
                            @endcan
                            @can('delete', $upah)
                                <form method="POST" action="{{ route('upah.destroy', $upah) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus upah ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button size="xs" variant="danger" icon="fas fa-trash" type="submit">
                                        Hapus
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
                            <i class="fas fa-money-bill-wave text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada upah</p>
                            <p class="mt-2 mb-4">Upah lembur akan muncul di sini.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        @if ($upahs->hasPages())
            <div class="mt-4">
                {{ $upahs->links() }}
            </div>
        @endif
    </x-ui.card>
</x-layout.dashboard>
