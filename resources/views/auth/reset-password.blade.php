<x-layout.auth title="Reset Kata Sandi" subtitle="Buat kata sandi baru untuk akun Anda">

    <x-slot name="footer">
        <p>Ingat kata sandi Anda?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Masuk di sini</a>
        </p>
    </x-slot>

    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shield-alt text-2xl text-green-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Buat Kata Sandi Baru</h2>
        <p class="text-gray-600">Masukkan kata sandi baru Anda di bawah ini untuk menyelesaikan proses reset</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6" x-data="{ showPassword: false, showPasswordConfirmation: false }">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-gray-400"></i>Alamat Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                autofocus autocomplete="username" readonly
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
            @error('email')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>Kata Sandi Baru
            </label>
            <div class="relative">
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror"
                    placeholder="Masukkan kata sandi baru">
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>Konfirmasi Kata Sandi Baru
            </label>
            <div class="relative">
                <input id="password_confirmation" :type="showPasswordConfirmation ? 'text' : 'password'"
                    name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password_confirmation') border-red-500 @enderror"
                    placeholder="Konfirmasi kata sandi baru">
                <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas" :class="showPasswordConfirmation ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Requirements -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-700 font-medium mb-2">
                <i class="fas fa-info-circle mr-1"></i>Ketentuan Kata Sandi:
            </p>
            <ul class="text-sm text-blue-600 space-y-1">
                <li>• Minimal 8 karakter</li>
                <li>• Mengandung huruf besar dan kecil</li>
                <li>• Mengandung minimal satu angka</li>
                <li>• Mengandung minimal satu karakter khusus</li>
            </ul>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-4 rounded-lg font-medium hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
            <i class="fas fa-check mr-2"></i>Reset Kata Sandi
        </button>

        <!-- Back to Login -->
        <a href="{{ route('login') }}"
            class="w-full border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Login
        </a>
    </form>
</x-layout.auth>
