<x-layout.dashboard title="Main">

    <div>
        @hasanyrole('Pimpinan|HRD')
            @if ($stats['persetujuan'] > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Peringatan:</strong> Ada <strong>{{ $stats['persetujuan'] }}</strong> permintaan
                                lembur yang belum ditindak lanjut.
                                <a href="{{ route('persetujuan.index') }}"
                                    class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Lihat sekarang <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endhasanyrole
        <div
            class="grid grid-cols-1 md:grid-cols-2 @hasanyrole('Pimpinan|HRD') lg:grid-cols-4 @else lg:grid-cols-3 @endhasanyrole gap-6 mb-8">
            @hasanyrole('Pimpinan|HRD')
                <!-- Stat Card 1 - Total Karyawan (Only for Pimpinan & HRD) -->
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Karyawan</h3>
                        <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_karyawan']) }}</p>
                        <p class="text-xs text-blue-500 flex items-center">
                            <i class="fas fa-user-check mr-1"></i> Karyawan aktif
                        </p>
                    </div>
                </div>
            @endhasanyrole

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mr-4">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Catatan Lembur</h3>
                    <p class="text-2xl font-semibold text-gray-800">
                        {{ number_format($stats['total_catatan_lembur']) }}</p>
                    <p class="text-xs text-green-500 flex items-center">
                        <i class="fas fa-clock mr-1"></i> Lembur tercatat
                    </p>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Persetujuan</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_persetujuan']) }}
                    </p>
                    <p class="text-xs text-purple-500 flex items-center">
                        <i class="fas fa-thumbs-up mr-1"></i> Lembur disetujui
                    </p>
                </div>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 mr-4">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Upah Lembur</h3>
                    <p class="text-2xl font-semibold text-gray-800">Rp
                        {{ number_format($stats['total_upah'], 0, ',', '.') }}</p>
                    <p class="text-xs text-yellow-500 flex items-center">
                        <i class="fas fa-coins mr-1"></i> Pembayaran lembur
                    </p>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan Lembur Bulanan</h3>
                <canvas id="overtimeChart" height="300"></canvas>
            </div>

            @hasanyrole('Pimpinan|HRD')
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Karyawan per Departemen</h3>
                    <canvas id="departmentChart" height="300"></canvas>
                </div>
            @else
                <!-- Recent Activity for Karyawan -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan Lembur Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Karyawan</th>
                                    <th
                                        class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jam Kerja</th>
                                    <th
                                        class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Durasi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOvertime as $overtime)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                                        {{ substr($overtime->karyawan->nama, 0, 1) }}</div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $overtime->karyawan->nama }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $overtime->karyawan->jabatan->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $overtime->tanggal->format('d M Y') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $overtime->jam_masuk_formatted }} -
                                            {{ $overtime->jam_keluar_formatted }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $overtime->durasi_lembur }}
                                                jam</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada catatan
                                            lembur</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endhasanyrole
        </div>

        @hasanyrole('Pimpinan|HRD')
            <!-- Recent Activity for Pimpinan/HRD -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan Lembur Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Karyawan</th>
                                <th
                                    class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jam Kerja</th>
                                <th
                                    class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Durasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentOvertime as $overtime)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                                    {{ substr($overtime->karyawan->nama, 0, 1) }}</div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $overtime->karyawan->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $overtime->karyawan->jabatan->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $overtime->tanggal->format('d M Y') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $overtime->jam_masuk_formatted }} -
                                        {{ $overtime->jam_keluar_formatted }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $overtime->durasi_lembur }}
                                            jam</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada catatan lembur
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endhasanyrole
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Overtime Chart
            const overtimeCtx = document.getElementById('overtimeChart');
            if (overtimeCtx) {
                new Chart(overtimeCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: @json($monthlyLabels),
                        datasets: [{
                            label: 'Jumlah Catatan Lembur',
                            data: @json($monthlyOvertime),
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            }

            @hasanyrole('Pimpinan|HRD')
                // Department Chart
                const departmentCtx = document.getElementById('departmentChart');
                if (departmentCtx) {
                    const departmentLabels = @json($departmentStats->pluck('name'));
                    const departmentData = @json($departmentStats->pluck('karyawans_count'));
                    if (departmentData.length > 0 && departmentData.some(d => d > 0)) {
                        new Chart(departmentCtx.getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: departmentLabels,
                                datasets: [{
                                    data: departmentData,
                                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6',
                                        '#9ca3af',
                                        '#ef4444',
                                        '#06b6d4'
                                    ]
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    } else {
                        departmentCtx.parentElement.innerHTML =
                            '<p class="text-gray-500 text-center py-8">Belum ada data karyawan per departemen</p>';
                    }
                }
            @endhasanyrole
        });
    </script>
</x-layout.dashboard>
