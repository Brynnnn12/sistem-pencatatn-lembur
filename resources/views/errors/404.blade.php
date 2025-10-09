<x-layout.landing>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="flex items-center justify-between space-x-12 max-w-6xl mx-auto w-full">
            <!-- Text Content -->
            <div class="text-center flex-1">
                <!-- Error Code -->
                <h1 class="text-8xl font-bold text-gray-800 mb-6">404</h1>

                <!-- Error Message -->
                <h2 class="text-3xl font-semibold text-gray-700 mb-10">Halaman tidak ditemukan</h2>

                <!-- Back Button -->
                <a href="{{ url('/') }}"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 text-lg">
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Rocket Container -->
            <div x-data="rocket()" class="flex-1 relative">
                <div class="rocket-container" @mousemove="moveRocket" @mouseleave="resetRocket">

                    <!-- Rocket Image -->
                    <img src="/image/4044.gif" alt="404 Animation"
                        class="h-96 w-auto mx-auto transition-all duration-200" :style="rocketStyle">
                </div>

                <!-- Instruction Text -->
                <p class="text-center text-gray-500 text-sm mt-4">
                    Arahkan mouse untuk menggerakkan roket
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('rocket', () => ({
                rotationX: 0,
                rotationY: 0,
                scale: 1,

                get rocketStyle() {
                    return `transform: perspective(1000px) rotateX(${this.rotationX}deg) rotateY(${this.rotationY}deg) scale(${this.scale});`;
                },

                moveRocket($event) {
                    const container = $event.currentTarget.getBoundingClientRect();
                    const centerX = container.left + container.width / 2;
                    const centerY = container.top + container.height / 2;

                    // Calculate rotation based on mouse position relative to center
                    this.rotationY = (($event.clientX - centerX) / container.width) *
                    30; // Max 30 degrees
                    this.rotationX = ((centerY - $event.clientY) / container.height) *
                    30; // Max 30 degrees
                    this.scale = 1.05;
                },

                resetRocket() {
                    this.rotationX = 0;
                    this.rotationY = 0;
                    this.scale = 1;
                }
            }));
        });
    </script>
</x-layout.landing>
