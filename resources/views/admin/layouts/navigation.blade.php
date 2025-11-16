<div x-show="sidebarOpen" @click.away="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" x-cloak>
</div>

<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"

    class="fixed inset-y-0 left-0 w-60 bg-white border-r shadow-sm transform transition-transform duration-300 z-50 md:relative md:translate-x-0">
    <div class="p-4 flex flex-col h-full">
        <div class="flex items-center justify-between">
            <img src="{{ asset('assets/icon/logo.png') }}" alt="KampusCare Logo"
                class="w-24 h-24 object-contain mb-6 mx-auto" />
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 focus:outline-none">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md transition">
                <i class="mdi mdi-view-dashboard text-lg"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.pasien.index') }}"
                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md transition">
                <i class="fa-solid fa-user text-base"></i>
                <span>Pasien</span>
            </a>

            <a href="{{ route('admin.prodi.index') }}"
                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md transition">
                <i class="fa-solid fa-graduation-cap text-base"></i>
                <span>Program Studi</span>
            </a>
            <a href="{{ route('admin.visit.index') }}"
                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md transition">
                <i class="fa-solid fa-stethoscope text-base"></i> {{-- Using a stethoscope icon for visit --}}
                <span>Kunjungan</span>
            </a>
        </nav>

        <div class="mt-auto border-t pt-4 text-sm">
            <span class="text-gray-700">{{ Auth::user()->nama }}</span>

            <a href="{{ route('profile.edit') }}" class="block text-blue-500 hover:underline mt-2">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline mt-2">Log Out</button>
            </form>
        </div>
    </div>
</aside>
