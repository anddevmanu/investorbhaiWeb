@extends('editor.layouts.master')

@section('title')
    <title>Question Post - Investorbhai</title>
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Ask Question</h1>
            <a href="{{ route('category.list') }}" class="btn btn-primary btn-sm flex items-center">
                <i class="fas fa-list fa-sm text-white-50"></i> Question List
            </a>
        </div>

        @include('admin.layouts.message')

        <!-- Category Form -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Blog Title -->
                    <div>
                        <label for="title" class="block text-gray-700">Question Title<span class="text-red-500">*</span></label>
                        <input type="text" id="title" required name="title" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('title') border-red-500 @enderror"
                            placeholder="Enter your Question title" value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="">
                        <label for="tags" class="block text-gray-700 font-bold mb-2">Question Tags</label>
                        <div class="relative">
                            <input type="text" id="tags" name="tags[]"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Type a tag and press Enter" autocomplete="off" />
                            <div id="tag-preview" class="flex flex-wrap gap-2 mt-2"></div>
                            <!-- Hidden field to store tags in a format suitable for submission -->
                            <input type="hidden" id="tags-hidden" name="tags"
                                value="{{ old('tags') ? old('tags') : '[]' }}">
                        </div>
                        @error('tags')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <p class="text-muted mt-1">You can add a maximum of 5 tags only.</p>
                    </div>
                    <!-- Question Status -->
                    <div>
                        <label for="status" class="block text-gray-700">Question Status <span class="text-red-500">*</span></label>
                        <select id="status" required name="status" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-check"></i> Create Question
                    </button>
                </div>
            </form>
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
                        tagElement.className =
                            'bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center';
                        tagElement.textContent = tag;

                        // Remove button
                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'x';
                        removeButton.className =
                            'ml-2 bg-blue-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs';
                        removeButton.onclick = () => {
                            tags = tags.filter(t => t !== tag);
                            updateTagPreview();
                            tagsHiddenInput.value = JSON.stringify(tags); // Update hidden input
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
                            tagsHiddenInput.value = JSON.stringify(tags); // Update hidden input
                        }
                    }
                });

                // Initialize tag preview with existing tags
                updateTagPreview();
            });
        </script>

    @endsection
