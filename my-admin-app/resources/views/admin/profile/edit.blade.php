<x-admin.layout :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        //  ['label' => 'Profile', 'url' => route('admin.profile.edit')],
        ['label' => 'Edit Profile']
    ]">
    <div class="max-w-xll mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <x-heroicon-o-user class="w-6 h-6 text-gray-500" />
            Edit Profile
        </h1>

        
    

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', auth('admin')->user()->name) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
                @error('name')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', auth('admin')->user()->email) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed" readonly>
            </div>

            <!-- Password -->
            <div class="mb-4" x-data="{ show: false }">
                <label for="password" class="block font-semibold mb-1">Password<small class="text-gray-500">(leave
                        blank to keep current password)</small></label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" id="password"
                        class="w-full border border-gray-300 rounded px-3 py-2 pr-10"
                        placeholder="New Password (optional)">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.977 9.977 0 012.303-3.592M6.1 6.1a9.974 9.974 0 0113.8 0M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m0 0a3 3 0 003 3m0 0a3 3 0 003-3m-3 3v0m-6-6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4" x-data="{ show: false }">
                <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation"
                        class="w-full border border-gray-300 rounded px-3 py-2 pr-10" placeholder="Confirm Password">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.977 9.977 0 012.303-3.592M6.1 6.1a9.974 9.974 0 0113.8 0M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m0 0a3 3 0 003 3m0 0a3 3 0 003-3m-3 3v0m-6-6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- <div class="mb-4">
                <label for="password" class="block font-semibold mb-1">New Password <small class="text-gray-500">(leave
                        blank to keep current password)</small></label>
                <input id="password" type="password" name="password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('password')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div> --}}

            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-500 transition">
                Save Changes
            </button>
        </form>
    </div>
</x-admin.layout>