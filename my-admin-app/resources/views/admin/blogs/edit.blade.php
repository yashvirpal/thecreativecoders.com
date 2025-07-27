<x-admin.layout :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Blogs', 'url' => route('admin.blogs.index')],
        ['label' => 'Edt Blog']
    ]">
    <div class="max-w-xll mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <x-heroicon-o-book-open class="w-6 h-6 text-gray-500" />
            Edit Blog
        </h1>

        <<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            {{-- Slug --}}
            <div class="mb-4">
                <label for="slug" class="block font-semibold mb-1">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            {{-- Content --}}
            <div class="mb-4">
                <label for="content" class="block font-semibold mb-1">Content</label>
                <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 rounded px-3 py-2"
                    required>{{ old('content', $blog->content) }}</textarea>
            </div>

            {{-- Banner --}}
            <div class="mb-4">
                <label for="banner" class="block font-semibold mb-1">Banner Image</label>
                @if ($blog->banner)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $blog->banner) }}" alt="Banner" class="w-32 rounded">
                    </div>
                @endif
                <input type="file" name="banner" id="banner" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Banner Alt --}}
            <div class="mb-4">
                <label for="banner_alt" class="block font-semibold mb-1">Banner Alt Text</label>
                <input type="text" name="banner_alt" id="banner_alt" value="{{ old('banner_alt', $blog->banner_alt) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Image --}}
            <div class="mb-4">
                <label for="image" class="block font-semibold mb-1">Featured Image</label>
                @if ($blog->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Image" class="w-32 rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Image Alt --}}
            <div class="mb-4">
                <label for="image_alt" class="block font-semibold mb-1">Image Alt Text</label>
                <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt', $blog->image_alt) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Meta Title --}}
            <div class="mb-4">
                <label for="meta_title" class="block font-semibold mb-1">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $blog->meta_title) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Meta Description --}}
            <div class="mb-4">
                <label for="meta_description" class="block font-semibold mb-1">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description"
                    value="{{ old('meta_description', $blog->meta_description) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Meta Keyword --}}
            <div class="mb-4">
                <label for="meta_keyword" class="block font-semibold mb-1">Meta Keywords</label>
                <input type="text" name="meta_keyword" id="meta_keyword"
                    value="{{ old('meta_keyword', $blog->meta_keyword) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block font-semibold mb-1">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="draft" {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>
                        Published</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
            </form>

    </div>
</x-admin.layout>