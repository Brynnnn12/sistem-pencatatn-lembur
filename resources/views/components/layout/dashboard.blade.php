<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased" x-data="{ isSidebarOpen: false, activeTab: '{{ $title ?? 'Dashboard' }}' }">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <x-dashboard.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 md:ml-64">
            <!-- Header -->
            <x-dashboard.header />

            <!-- Mobile Sidebar -->
            <x-dashboard.mobile-sidebar />

            <!-- Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="w-full max-w-full px-2 sm:px-4 md:px-8 py-6 mx-auto">
                    <x-feedback.flash-messages />
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.6);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.8);
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Focus styles */
        .focus\:ring-blue-500:focus {
            --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity));
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>




</body>

</html>
