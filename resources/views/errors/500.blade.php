<x-layout.landing>
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="flex items-center space-x-10 max-w-8xl mx-auto">
            <div class="text-center flex-1">
                <div class="mb-8">
                    <h1 class="text-8xl font-bold text-red-600 mb-4 animate-float">500</h1>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-pink-600 mx-auto rounded-full"></div>
                </div>

                <h2 class="text-3xl font-semibold text-gray-700 mb-4">Terjadi Kesalahan Server</h2>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Maaf, terjadi kesalahan pada server. Tim kami telah diberitahu dan sedang memperbaikinya.
                    Silakan coba lagi nanti.
                </p>

                <div class="space-y-4">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>

                    <div>
                        <button onclick="window.location.reload()"
                            class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                            <i class="fas fa-refresh mr-2"></i>
                            Muat Ulang Halaman
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <img src="/image/500.gif" alt="500 Error Animation" class="h-80 w-auto mx-auto">
            </div>
        </div>
    </div>
</x-layout.landing>
