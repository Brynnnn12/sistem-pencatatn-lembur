<x-layout.auth title="Konfirmasi Kata Sandi" subtitle="Konfirmasi kata sandi Anda untuk melanjutkan">

    <x-slot name="footer">
        <p>Ingat kata sandi Anda?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Masuk di sini</a>
        </p>
    </x-slot>

    <div class="text-center mb-6">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-shield-alt text-lg sm:text-2xl text-yellow-600"></i>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">Konfirmasi Kata Sandi</h2>
        <p class="text-sm text-gray-600">Ini adalah area aman. Konfirmasi kata sandi Anda untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4" x-data="{ showPassword: false }">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                <i class="fas fa-lock mr-1.5 text-gray-400 text-xs"></i>Kata Sandi
            </label>
            <div class="relative">
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                    autocomplete="current-password"
                    class="w-full px-3 py-2.5 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror"
                    placeholder="Masukkan kata sandi Anda">
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas text-xs" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-xs text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-2.5 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transform hover:scale-[1.01] transition-all duration-200 shadow-md text-sm">
            <i class="fas fa-check mr-2 text-xs"></i>Konfirmasi
        </button>
    </form>
</x-layout.auth>
