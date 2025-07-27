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

                @if ($admin->avatar)
                    <img src="{{ asset('storage/avatars/' . $admin->avatar) }}" class="w-8 h-8 rounded-full object-cover" />
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=4B5563&color=fff"
                        class="w-8 h-8 mx-auto rounded-full" />
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="open" x-cloak @click.away="open = false" role="menu" aria-orientation="vertical"
                aria-label="Admin menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-2">

                {{-- <a href="javascript:void(0)"
                    class="block px-4 py-2 text-sm text-center text-gray-700 hover:bg-gray-100">
                    <span class="text-sm text-gray-700 hidden md:inline">{{ $admin->name }}</span>
                </a> --}}

                <a href="{{ route('admin.profile.edit') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                    Profile
                </a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        <x-heroicon-o-power class="w-5 h-5 text-red-500" />
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</header>