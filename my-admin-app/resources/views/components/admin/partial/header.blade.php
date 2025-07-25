<!-- Header -->
@php $admin = auth('admin')->user(); @endphp
<header class="h-16 bg-white shadow flex items-center justify-between px-4">
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700">
        <svg x-show="!sidebarOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <svg x-show="sidebarOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex items-center space-x-3">
        @php
            $admin = auth('admin')->user();
        @endphp

        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=4B5563&color=fff&size=64"
                    alt="Avatar" class="w-8 h-8 rounded-full" />
                <span class="text-sm text-gray-700 hidden md:inline">Welcome, {{ $admin->name }}</span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-2">
                <a href="{{ route('admin.profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>