<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                         <!-- Hidden user_id field -->
                         <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                         
                        <div>
                            <x-input-label for="caption" :value="__('Caption')" />
                            <x-text-input id="caption" name="caption" type="text" required class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Post Image')" />
                            <input type="file" name="image" id="image" required class="form-input mt-1 block w-full">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <x-primary-button class="mt-4">{{ __('Create Post') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
