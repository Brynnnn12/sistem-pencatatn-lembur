<x-layout.dashboard title="Manajemen Persetujuan">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Persetujuan</h3>
        </x-slot>


        <!-- Persetujuan Table -->
        <x-table.table :headers="['No', 'Catatan Lembur', 'Karyawan', 'Approver', 'Status', 'Tanggal', 'Aksi']" striped hover>
            @forelse ($persetujuans as $persetujuan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <div>
                            <div class="text-sm text-gray-900">
                                {{ $persetujuan->catatanLembur->tanggal->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $persetujuan->catatanLembur->jam_masuk_formatted }} -
                                {{ $persetujuan->catatanLembur->jam_keluar_formatted }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $persetujuan->catatanLembur->karyawan->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $persetujuan->user ? $persetujuan->user->name : 'Belum ditentukan' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $persetujuan->status_color }}-100 text-{{ $persetujuan->status_color }}-800">
                            <i class="{{ $persetujuan->status_icon }} mr-1"></i>
                            {{ ucfirst($persetujuan->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $persetujuan->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            @can('view', $persetujuan)
                                <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                    onclick="location.href='{{ route('persetujuan.show', $persetujuan) }}'">
                                    Lihat
                                </x-ui.button>
                            @endcan
                            {{-- jika status di setujui jangan tampilkan sembunyikan --}}
                            @if ($persetujuan->status !== 'disetujui')
                                @can('update', $persetujuan)
                                    <form action="{{ route('persetujuan.updateStatus', $persetujuan) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <x-ui.button size="xs" variant="success" icon="fas fa-check" type="submit">
                                            Setujui
                                        </x-ui.button>
                                    </form>
                                    <form action="{{ route('persetujuan.updateStatus', $persetujuan) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <x-ui.button size="xs" variant="danger" icon="fas fa-times" type="submit">
                                            Tolak
                                        </x-ui.button>
                                    </form>
                                @endcan
                            @endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-check-circle text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada persetujuan</p>
                            <p class="mt-2 mb-4">Persetujuan lembur akan muncul di sini.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $persetujuans->links('vendor.pagination.tailwind') }}
        </div>
    </x-ui.card>

</x-layout.dashboard>
