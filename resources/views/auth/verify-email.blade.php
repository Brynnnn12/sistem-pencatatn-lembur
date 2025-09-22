<x-layout.auth title="Verifikasi Email" subtitle="Periksa kotak masuk Anda dan klik tautan verifikasi">

    <x-slot name="footer">
        <p>Butuh bantuan?
            <a href="#" class="text-blue-400 hover:text-blue-300 font-medium">Hubungi dukungan</a>
        </p>
    </x-slot>

    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-envelope-open-text text-3xl text-yellow-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Verifikasi Email Anda</h2>
        <p class="text-gray-600 max-w-md mx-auto">
            Terima kasih telah mendaftar! Kami telah mengirim tautan verifikasi ke alamat email Anda.
            Silakan periksa kotak masuk Anda dan klik tautan untuk memverifikasi akun Anda.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span class="font-medium">Email Terkirim!</span>
            </div>
            <p class="mt-1 text-sm">Tautan verifikasi baru telah dikirim ke alamat email Anda.</p>
        </div>
    @endif

    <!-- Email Check Instructions -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
        <h3 class="font-medium text-blue-800 mb-3">
            <i class="fas fa-info-circle mr-2"></i>Yang harus dilakukan selanjutnya:
        </h3>
        <ol class="text-sm text-blue-700 space-y-2">
            <li class="flex items-start">
                <span
                    class="inline-flex items-center justify-center w-5 h-5 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">1</span>
                Periksa kotak masuk email Anda (termasuk folder spam/junk)
            </li>
            <li class="flex items-start">
                <span
                    class="inline-flex items-center justify-center w-5 h-5 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">2</span>
                Cari email dari sistem kami
            </li>
            <li class="flex items-start">
                <span
                    class="inline-flex items-center justify-center w-5 h-5 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">3</span>
                Klik tautan verifikasi di email
            </li>
        </ol>
    </div>

    <div class="space-y-4">
        <!-- Resend Email Button -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                <i class="fas fa-paper-plane mr-2"></i>Kirim Ulang Email Verifikasi
            </button>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Atau</span>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i>Keluar
            </button>
        </form>
    </div>

    <!-- Email Troubleshooting -->
    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
        <h4 class="text-sm font-medium text-gray-800 mb-2">
            <i class="fas fa-question-circle mr-1"></i>Tidak menerima email?
        </h4>
        <ul class="text-sm text-gray-600 space-y-1">
            <li>• Periksa folder spam atau junk mail Anda</li>
            <li>• Pastikan alamat email sudah benar</li>
            <li>• Coba klik "Kirim Ulang Email Verifikasi"</li>
            <li>• Hubungi dukungan jika terus mengalami masalah</li>
        </ul>
    </div>
</x-layout.auth>
