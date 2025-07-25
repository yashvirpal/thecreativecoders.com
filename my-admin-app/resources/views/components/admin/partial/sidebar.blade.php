<!-- resources/views/components/admin/partial/sidebar.blade.php -->

<div class="sidebar bg-gray-800 text-white p-4 w-64 min-h-screen">
    <h2 class="text-xl font-bold mb-6">Admin Menu</h2>

    <ul>
        @if(auth('admin')->check() && auth('admin')->user()->hasRole('super_admin'))
            {{-- menu item --}}
            <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">Manage Users</a></li>

        @endif

        @if(auth('admin')->check() && auth('admin')->user()->hasRole('admin'))
            <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">Manage Posts</a></li>
       
        @endif
        @if(auth('admin')->check() && auth('admin')->user()->hasRole('admin'))
        @if(auth('admin')->user()->hasPermission('view_reports'))
            <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">View Reports</a></li>
        @endif
        @endif
    </ul>
</div>
