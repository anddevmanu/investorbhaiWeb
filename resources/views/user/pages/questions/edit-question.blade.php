@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - Edit Question</title>
@endsection

@section('content')
    <div class="main_content_wrapper p-4">

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Content for the left side -->
        <h3 class="page-header border-b pb-2 mb-3">Edit Question</h3>

        <!-- Flex container for form and sidebar -->
        <div class="flex flex-col lg:flex-row">
            <!-- Form Section -->
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-3/4">
                <form action="{{ route('update.post', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Question Title</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Your question title" value="{{ old('title', $question->title) }}" />
                        @error('title')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="tags" class="block text-gray-700 font-bold mb-2">Question Tags</label>
                        <div class="relative">
                        @php
                            $tagsArray = is_array($question->tags) ? $question->tags : json_decode($question->tags, true);
                            $tagsString = implode(',', $tagsArray ?? []);
                        @endphp
                            <input type="text" id="tags" name="tags"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Type a tag and press Enter" autocomplete="off" />
                            <div id="tag-preview" class="flex flex-wrap gap-2 mt-2"></div>

                            <input type="hidden" id="tags-hidden" name="tags-hidden"
                                value="{{ json_encode($tagsArray) }}">
                        </div>
                        @error('tags')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <p class="text-muted mt-1">You can add a maximum of 5 tags only.</p>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                </form>
            </div>

            <!-- Sidebar Section -->

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagInput = document.getElementById('tags');
            const tagPreview = document.getElementById('tag-preview');
            const tagsHiddenInput = document.getElementById('tags-hidden');
            let tags = JSON.parse(tagsHiddenInput.value || '[]');

            // Function to update tag preview and hidden input
            function updateTagPreview() {
                tagPreview.innerHTML = ''; // Clear current tags
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.className = 'bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center';
                    tagElement.textContent = tag;

                    // Remove button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'x';
                    removeButton.className = 'ml-2 bg-blue-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs';
                    removeButton.onclick = () => {
                        tags = tags.filter(t => t !== tag);
                        updateTagPreview();
                        tagsHiddenInput.value = JSON.stringify(tags);
                    };

                    tagElement.appendChild(removeButton);
                    tagPreview.appendChild(tagElement);
                });
            }

            // Handle tag addition
            tagInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const newTag = tagInput.value.trim();
                    if (newTag && tags.length < 5 && !tags.includes(newTag)) {
                        tags.push(newTag);
                        updateTagPreview();
                        tagInput.value = '';
                        tagsHiddenInput.value = JSON.stringify(tags);
                    }
                }
            });


            updateTagPreview();
        });
    </script>
@endsection
