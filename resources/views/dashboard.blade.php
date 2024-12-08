<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <!-- User Profile Info -->
            <div class="flex items-center space-x-4">
                <!-- Display User Avatar -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300">
                        <!-- Display user avatar here -->
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="Profile Image" class="w-full h-full object-cover">
                        @else
                            <span class="text-white flex items-center justify-center w-full h-full bg-blue-500">
                                {{ strtoupper(substr(auth()->user()->fname, 0, 1)) }}{{ strtoupper(substr(auth()->user()->lname, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Display Full Name and Username -->
                <div class="text-right">
                    <!-- Full Name -->
                    <p class="text-sm font-medium text-gray-800">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</p>

                    <!-- Email (Username) -->
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    <span>{{ __("You're logged in!") }}</span>
                    <a href="{{ route('post.create') }}" class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                         Post
                    </a>
                </div>
            </div>
        </div>
    </div>

     <!-- Display All Posts -->
     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @foreach ($posts as $post)
            <div class="mb-6 border-b pb-6">
                <!-- Post Image -->
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-4/5 mx-auto h-96 object-cover rounded-lg shadow-md mb-4">

                <!-- Post Caption -->
                <p class="font-semibold text-lg mb-2">{{ $post->caption }}</p>

                <!-- Post Details: Likes, Username, and Date -->
                <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
                    <div class="flex items-center">
                        <!-- Like Button -->
                        <span 
                            class="like-btn cursor-pointer text-xl text-red-500 mr-2" 
                            data-post-id="{{ $post->id }}" 
                            id="like-btn-{{ $post->id }}"
                            title="Like">
                            &#10084;
                        </span>
                        <span id="likes-count-{{ $post->id }}">{{ $post->likes }}</span> Likes
                    </div>
                    <div>
                        <!-- Username -->
                        <span class="font-medium">{{ $post->user->fname }} {{ $post->user->lname }}</span>

                        <!-- Formatted Date -->
                        <span class="ml-2 text-xs">{{ $post->created_at->format('F j, Y, g:i a') }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeIcons = document.querySelectorAll('.like-btn');

        likeIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const postId = this.dataset.postId;

                fetch('/like-post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ post_id: postId })
                })
                .then(response => response.json())
                .then(data => {
                    const likesCount = document.getElementById(`likes-count-${postId}`);
                    const likeButton = document.getElementById(`like-btn-${postId}`);

                    // Update the like count
                    likesCount.textContent = data.likes_count;

                    // Toggle the like color
                    if (data.liked) {
                        likeButton.classList.add('text-red-600');
                    } else {
                        likeButton.classList.remove('text-red-600');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>


</x-app-layout>
