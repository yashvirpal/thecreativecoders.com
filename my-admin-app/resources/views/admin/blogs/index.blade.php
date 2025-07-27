<x-admin.layout title="Blogs List">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Blog</a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3">ID</th>
                <th class="p-3">Title</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
                <tr>
                    <td class="p-3">{{ $blog->id }}</td>
                    <td class="p-3">{{ $blog->title }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-blue-600 hover:underline">Edit</a>

                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this blog?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-3 text-center">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $blogs->links() }}
    </div>

</x-admin.layout>
