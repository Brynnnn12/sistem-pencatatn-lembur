@props([
    'type' => 'info', // success, error, warning, info
    'title' => '', // Judul alert
    'text' => '', // Teks alert
    'confirmButton' => 'OK', // Teks tombol konfirmasi
    'showOnLoad' => false, // Tampilkan saat halaman load
    'timer' => null, // Auto close dalam milidetik
    'position' => 'center', // Posisi untuk toast
    'toast' => false, // Mode toast atau modal
    'width' => null, // Lebar custom (contoh: '500px', '80%')
    'grow' => null, // Preset ukuran: 'row', 'column', 'fullscreen'
    'size' => 'normal', // Ukuran preset: small, normal, large, extra-large
])

@php
    $alertConfig = [
        'success' => [
            'icon' => 'success',
            'confirmButtonColor' => '#10b981',
        ],
        'error' => [
            'icon' => 'error',
            'confirmButtonColor' => '#dc2626',
        ],
        'warning' => [
            'icon' => 'warning',
            'confirmButtonColor' => '#f59e0b',
        ],
        'info' => [
            'icon' => 'info',
            'confirmButtonColor' => '#3b82f6',
        ],
    ];

    $config = $alertConfig[$type] ?? $alertConfig['info'];

    // Size configurations
    $sizeConfig = [
        'small' => ['width' => '300px'],
        'normal' => ['width' => '400px'],
        'large' => ['width' => '500px'],
        'extra-large' => ['width' => '600px'],
    ];

    $currentSize = $sizeConfig[$size] ?? $sizeConfig['normal'];

    // Override width if explicitly set
    if ($width) {
        $currentSize['width'] = $width;
    }
@endphp

@if ($showOnLoad)
    <style>
        /* Hot Toast Style untuk Toast Mode */
        @if ($toast)
            .swal2-toast {
                font-size: 14px !important;
                padding: 12px 16px !important;
                border-radius: 8px !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
                min-width: auto !important;
                max-width: 320px !important;
            }

            .swal2-toast .swal2-title {
                font-size: 14px !important;
                font-weight: 600 !important;
                margin: 0 0 4px 0 !important;
                line-height: 1.2 !important;
            }

            .swal2-toast .swal2-html-container {
                font-size: 13px !important;
                line-height: 1.3 !important;
                margin: 0 !important;
                color: #374151 !important;
            }

            .swal2-toast.swal2-success {
                background: #ecfdf5 !important;
                border-left: 4px solid #10b981 !important;
            }

            .swal2-toast.swal2-error {
                background: #fef2f2 !important;
                border-left: 4px solid #dc2626 !important;
            }

            .swal2-toast.swal2-warning {
                background: #fffbeb !important;
                border-left: 4px solid #f59e0b !important;
            }

            .swal2-toast.swal2-info {
                background: #eff6ff !important;
                border-left: 4px solid #3b82f6 !important;
            }

            .swal2-toast .swal2-icon {
                width: 16px !important;
                height: 16px !important;
                margin: 0 8px 0 0 !important;
            }

            .swal2-toast .swal2-close {
                width: 12px !important;
                height: 12px !important;
                top: 8px !important;
                right: 8px !important;
                opacity: 0.6 !important;
            }

            .swal2-progress-bar {
                background: rgba(255, 255, 255, 0.8) !important;
            }

            /* Animasi smooth untuk Hot Toast style */
            .swal2-toast {
                animation: slideInRight 0.3s ease-out !important;
            }

            .swal2-toast.swal2-hide {
                animation: slideOutRight 0.3s ease-in !important;
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }

                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }

            /* Stack multiple toasts */
            .swal2-toast:nth-child(2) {
                margin-top: 8px !important;
            }

            .swal2-toast:nth-child(3) {
                margin-top: 16px !important;
            }
        @endif
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($toast)
                const Toast = Swal.mixin({
                    toast: true,
                    position: '{{ $position === 'center' ? 'top-end' : $position }}',
                    showConfirmButton: false,
                    timer: {{ $timer ?? 3000 }},
                    timerProgressBar: true,
                    showCloseButton: true,
                    customClass: {
                        popup: 'swal2-toast-custom',
                        title: 'swal2-toast-title-custom',
                        htmlContainer: 'swal2-toast-html-custom'
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: '{{ $config['icon'] }}',
                    title: '{{ $title }}',
                    html: '{{ $text }}'
                });
            @else
                Swal.fire({
                    @if ($title)
                        title: '{{ $title }}',
                    @endif
                    @if ($text)
                        text: '{{ $text }}',
                    @endif
                    icon: '{{ $config['icon'] }}',
                    confirmButtonColor: '{{ $config['confirmButtonColor'] }}',
                    confirmButtonText: '{{ $confirmButton }}',
                    width: '{{ $currentSize['width'] }}',
                    @if ($grow)
                        grow: '{{ $grow }}',
                    @endif
                    @if ($timer)
                        timer: {{ $timer }},
                    @endif
                    @if ($timer)
                        showConfirmButton: false,
                    @endif
                });
            @endif
        });
    </script>
@endif
