<x-layout.landing>
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="text-center max-w-md mx-auto">
            <div class="mb-8">
                <h1 class="text-8xl font-bold text-gray-800 mb-4 animate-float">404</h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto rounded-full"></div>
            </div>

            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.
                Mari kembali ke halaman utama.
            </p>

            <div class="space-y-4">
                <a href="{{ url('/') }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>

                <div>
                    <a href="javascript:history.back()"
                        class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout.landing>
