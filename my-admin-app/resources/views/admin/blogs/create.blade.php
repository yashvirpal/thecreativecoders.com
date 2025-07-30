<x-admin.layout :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Blogs', 'url' => route('admin.blogs.index')],
        ['label' => 'Create Blog']
    ]">
    <div class="max-w-xll mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <x-heroicon-o-book-open class="w-6 h-6 text-gray-500" />
            Create Blog
        </h1>


        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title & Slug --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="title" class="block font-semibold mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block font-semibold mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('slug')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            {{-- Banner & Banner Alt --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="banner" class="block font-semibold mb-1">Banner Image</label>
                    <input type="file" name="banner" id="banner"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('banner')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block font-semibold mb-1">Featured Image</label>
                    <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('image')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Image & Image Alt --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                <div>
                    <label for="banner_alt" class="block font-semibold mb-1">Banner Alt Text</label>
                    <input type="text" name="banner_alt" id="banner_alt" value="{{ old('banner_alt') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('banner_alt')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image_alt" class="block font-semibold mb-1">Image Alt Text</label>
                    <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('image_alt')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Content (Full Width) --}}
            <div class="mb-4">
                <label for="content" class="block font-semibold mb-1">Content</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $blog->content ?? '') }}">
                <trix-editor input="content" x-ignore></trix-editor>
                @error('content')
                    <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                @enderror

            </div>

            {{-- Meta Title & Description --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="meta_title" class="block font-semibold mb-1">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('meta_title')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="meta_description" class="block font-semibold mb-1">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description"
                        value="{{ old('meta_description') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('meta_description')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Meta Keyword & Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="meta_keyword" class="block font-semibold mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('meta_keyword')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block font-semibold mb-1">Status</label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1 capitalize">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Save
            </button>
        </form>


    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const banner = document.querySelector('input[name="banner"]');
                if (banner) {
                    FilePond.create(banner, {
                        storeAsFile: true,
                        allowMultiple: false
                    });
                }
                const image = document.querySelector('input[name="image"]');
                if (image) {
                    FilePond.create(image, {
                        storeAsFile: true,
                        allowMultiple: false
                    });
                }
            });
        </script>
    @endpush



</x-admin.layout>