<x-layout.auth title="Register" subtitle="Join us and start managing your data today">

    <x-slot name="footer">
        <p>Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Masuk di sini</a>
        </p>
    </x-slot>

    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">Buat Akun</h2>
        <p class="text-sm text-gray-600">Daftar untuk memulai</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ showPassword: false, showPasswordConfirmation: false, agreedToTerms: false }">
        @csrf

        <!-- Name and Email Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                    <i class="fas fa-user mr-1.5 text-gray-400 text-xs"></i>Nama Lengkap
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name"
                    class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="mt-1 text-xs text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                    <i class="fas fa-envelope mr-1.5 text-gray-400 text-xs"></i>Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="username"
                    class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                    placeholder="nama@email.com">
                @error('email')
                    <p class="mt-1 text-xs text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Password Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                    <i class="fas fa-lock mr-1.5 text-gray-400 text-xs"></i>Kata Sandi
                </label>
                <div class="relative">
                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                        autocomplete="new-password"
                        class="w-full px-3 py-2.5 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror"
                        placeholder="Masukkan kata sandi">
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

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                    <i class="fas fa-lock mr-1.5 text-gray-400 text-xs"></i>Konfirmasi Kata Sandi
                </label>
                <div class="relative">
                    <input id="password_confirmation" :type="showPasswordConfirmation ? 'text' : 'password'"
                        name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-3 py-2.5 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password_confirmation') border-red-500 @enderror"
                        placeholder="Konfirmasi kata sandi">
                    <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fas text-xs" :class="showPasswordConfirmation ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-xs text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start space-x-2">
            <input id="terms" type="checkbox" required x-model="agreedToTerms"
                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <label for="terms" class="text-sm text-gray-700">
                Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Syarat dan
                    Ketentuan</a>
                serta <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Kebijakan Privasi</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" :disabled="!agreedToTerms"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-2.5 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transform hover:scale-[1.01] transition-all duration-200 shadow-md text-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
            <i class="fas fa-user-plus mr-2 text-xs"></i>Buat Akun
        </button>

        <!-- Divider -->
        <div class="relative my-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-2 bg-white text-gray-500">Sudah punya akun?</span>
            </div>
        </div>

        <!-- Login Link -->
        <a href="{{ route('login') }}"
            class="w-full border border-gray-300 text-gray-700 py-2.5 px-4 rounded-lg font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-1 transition-colors duration-200 flex items-center justify-center text-sm">
            <i class="fas fa-sign-in-alt mr-2 text-xs"></i>Masuk Sekarang
        </a>
    </form>
</x-layout.auth>
