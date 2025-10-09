<!-- Header -->
<header class="">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Left Section -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button @click="isSidebarOpen = !isSidebarOpen"
                class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-bars text-lg"></i>
            </button>

            <!-- Breadcrumbs -->
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-home mr-1"></i>
                    Dashboard
                </a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-900 font-medium"
                    x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></span>
            </nav>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- User Menu -->
            <div class="relative" ">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span
                            class="font-bold text-white text-sm">{{ substr(Auth::user()->karyawan->nama, 0, 1) }}</span>
                    </div>

                </button>


            </div>
        </div>
    </div>
</header>
