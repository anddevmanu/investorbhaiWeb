@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Question</h1>
            <a href="{{ route('admin.question.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-list fa-sm text-white-50"></i> Question List
            </a>
        </div>

        @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Question</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Question Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $question->title) }}">
                        @error('title')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Question Tags</label>

                        @php
                            $tagsArray = is_array($question->tags) ? $question->tags : json_decode($question->tags, true);
                            $tagsString = implode(',', $tagsArray ?? []);
                        @endphp
                        <input type="text" id="tags" name="tags" class="form-control" placeholder="Type a tag and press Enter" value="">
                        <input type="hidden" id="tags-hidden" name="tags-hidden" value="{{ json_encode($tagsArray) }}">
                        @error('tags')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <p class="text-muted mt-2">You can add a maximum of 5 tags only.</p>
                        <div id="tag-preview" class="mt-2"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Question</button>
                </form>
            </div>
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
                    tagElement.className = 'badge badge-primary mr-2 mb-2';
                    tagElement.textContent = tag;

                    // Remove button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'x';
                    removeButton.className = 'btn btn-sm btn-danger ml-2';
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
