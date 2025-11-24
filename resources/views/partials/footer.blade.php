<!-- Footer -->
<footer class="bg-gradient-to-b from-[#6FCBFF] to-[#4FB7F0] border-t border-[#1C7DBD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Divider -->
        <div class="border-t border-white border-opacity-30 mb-6"></div>

        <!-- Bottom Section: Copyright and Social Icons -->
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Copyright -->
            <p class="text-xs text-white font-semibold order-2 md:order-1 opacity-70">
                © 2025 Kelompok 1 Unesa 5 MedicalCare
            </p>

            <!-- Social Media Icons -->
            <div class="flex gap-6 order-1 md:order-2 mb-4 md:mb-0 items-center">
                <!-- GitHub Icon -->
                <a href="https://github.com/1jaxxx/unesa5_medical_care" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-200 transition flex items-center gap-2" aria-label="GitHub">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    <span class="text-white text-sm font-semibold">GitHub</span>
                </a>

                <!-- About Us Icon -->
                <a href="{{ route('aboutus') ?? '/aboutus' }}" class="text-white hover:text-gray-200 transition flex items-center gap-2" aria-label="About Us">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span class="text-white text-sm font-semibold">About Us</span>
                </a>
            </div>
        </div>
    </div>
</footer>
