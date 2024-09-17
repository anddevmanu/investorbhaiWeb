@extends('admin.layouts.master')

@section('title')
    <title>Question Create - Investorbhai</title>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Question</h1>
            <a href="{{ route('question.list') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-list fa-sm text-white-50"></i> Question List
            </a>
        </div>

        @include('admin.layouts.message')

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Create New Question</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('question.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="title">Question Title</label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Enter your question title" value="{{ old('title') }}" />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tags">Question Tags</label>
                                <div class="input-group">
                                    <input type="text" id="tags" name="tags[]"
                                        class="form-control @error('tags') is-invalid @enderror"
                                        placeholder="Type a tag and press Enter" autocomplete="off" />
                                </div>
                                <div id="tag-preview" class="mt-2"></div>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">You can add a maximum of 5 tags only.</small>
                                <input type="hidden" id="tags-hidden" name="tags"
                                    value="{{ old('tags') ? old('tags') : '[]' }}">
                            </div>
                            <button type="submit"
                                class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

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
                        'badge badge-primary mr-2 mb-2';
                    tagElement.textContent = tag;

                    // Remove button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'x';
                    removeButton.className =
                        'btn btn-sm btn-danger ml-2';
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
