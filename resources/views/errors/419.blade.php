<x-layout.landing>
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="text-center max-w-md mx-auto">
            <div class="mb-8">
                <h1 class="text-8xl font-bold text-purple-600 mb-4 animate-float">419</h1>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-indigo-600 mx-auto rounded-full"></div>
            </div>

            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Sesi Berakhir</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Sesi Anda telah berakhir karena tidak ada aktivitas.
                Silakan refresh halaman atau login kembali.
            </p>

            <div class="space-y-4">
                <button onclick="window.location.reload()"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-refresh mr-2"></i>
                    Refresh Halaman
                </button>

                <div>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout.landing>
