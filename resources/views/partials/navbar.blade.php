<style>
    .active-nav {
        color: #2563eb;      /* Warna biru aktif */
        font-weight: 600;
    }
</style>

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <div class="flex-shrink-0">
                <a href="/" class="flex items-center space-x-2">
                    <img src="/assets/icon/icon.png" alt="KampusCare Logo" class="w-12" />
                    <img src="/assets/icon/logo.png" alt="KampusCare Logo" class="w-32" />
                </a>
            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-6">

                    <a href="#hero"
                        class="nav-link text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition">
                        Home
                    </a>

                    <a href="#services"
                        class="nav-link text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition">
                        Services
                    </a>

                    <a href="#about"
                        class="nav-link text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition">
                        About
                    </a>

                    <a href="#contact"
                        class="nav-link text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition">
                        Contact
                    </a>

                </div>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" type="button"
                    class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Buka menu</span>

                    <svg :class="{ 'hidden': open, 'block': !open }" class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg :class="{ 'block': open, 'hidden': !open }" class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="md:hidden" @click.away="open = false">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">

            <a href="#hero"
                class="nav-link text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">
                Home
            </a>

            <a href="#services"
                class="nav-link text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">
                Services
            </a>

            <a href="#about"
                class="nav-link text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">
                About
            </a>

            <a href="#contact"
                class="nav-link text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">
                Contact
            </a>

        </div>
    </div>
</nav>

<!-- ACTIVE NAV SCRIPT -->
<script>
document.addEventListener("scroll", () => {
    const sections = document.querySelectorAll("section[id]");
    const links = document.querySelectorAll(".nav-link");

    let current = "";

    sections.forEach(section => {
        const rect = section.getBoundingClientRect();
        if (rect.top <= 120 && rect.bottom > 120) {
            current = section.id;
        }
    });

    links.forEach(link => {
        link.classList.remove("active-nav");
        if (link.getAttribute("href") === "#" + current) {
            link.classList.add("active-nav");
        }
    });
});
</script>
