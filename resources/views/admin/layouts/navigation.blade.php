<div class="min-h-screen flex bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-60 bg-white border-r shadow-sm">
        <div class="p-4 flex flex-col h-full">
            {{-- Logo --}}
            <img src="{{ asset('assets/icon/logo.png') }}" alt="KampusCare Logo"
                class="w-14 h-14 object-contain mb-6 mx-auto" />

            {{-- Navigation --}}
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
            </nav>

            {{-- Footer --}}
            <div class="mt-auto border-t pt-4 text-sm">
                <span class="text-gray-700">{{ Auth::user()->nama }}</span>

                <a href="{{ route('profile.edit') }}"
                    class="block text-blue-500 hover:underline mt-2">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline mt-2">Log Out</button>
                </form>
            </div>
        </div>
    </aside>
</div>
