@extends('admin.layouts.master')

@section('title')
<title>Create Blog - InvestorBhai</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Blog</h1>
        <a href="{{ route('blog.list') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-list fa-sm text-white-50"></i> Blog List
        </a>
    </div>

    @include('admin.layouts.message')

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Blog</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Grid Layout -->
                        <div class="row">
                            <!-- Blog Title and Category in the first row -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="title">Blog Title</label>
                                    <input type="text" id="title" required name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter your blog title" value="{{ old('title') }}" />
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" required name="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Blog Content in the second row -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Blog Content</label>
                                    <x-ckeditor id="description" name="description" required value="{{ old('description', $initialValue ?? '') }}" />
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Other form elements in the subsequent rows -->
                        <div class="row">
                            <!-- Blog Tags -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" required id="tags" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter tags separated by commas" value="{{ old('tags') }}" />
                                    @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Example: tag1, tag2, tag3</small>
                                </div>
                            </div>

                            <!-- SEO Meta Title -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="meta_title">SEO Meta Title</label>
                                    <input type="text" required id="meta_title" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Enter SEO meta title" value="{{ old('meta_title') }}" />
                                    @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- SEO Meta Keywords -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="meta_keywords">SEO Meta Keywords</label>
                                    <textarea required id="meta_keywords" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Enter SEO meta keywords">{{ old('meta_keywords') }}</textarea>
                                    @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- SEO Meta Description -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="meta_description">SEO Meta Description</label>
                                    <textarea required id="meta_description" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Enter SEO meta description">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Blog Image -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Blog Image</label>
                                    <input required type="file" id="image" name="image" class="form-control-file @error('image') is-invalid @enderror">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">
                            Create Blog
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
