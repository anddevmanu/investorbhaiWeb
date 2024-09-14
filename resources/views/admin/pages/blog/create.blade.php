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

    <!-- Blog Form -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-blog"></i> Create New Blog
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Blog Information Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="font-weight-bold text-primary">
                                    <i class="fas fa-info-circle"></i> Blog Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <!-- Blog Title & Category -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title">Blog Title <span class="text-danger">*</span></label>
                                            <input type="text" id="title" required name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter your blog title" value="{{ old('title') }}">
                                            @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category">Category <span class="text-danger">*</span></label>
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

                                <!-- Blog Content -->
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="description">Blog Content <span class="text-danger">*</span></label>
                                            <x-ckeditor id="description" name="description" required value="{{ old('description', $initialValue ?? '') }}" />
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="font-weight-bold text-primary">
                                    <i class="fas fa-search"></i> SEO Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="meta_title">SEO Meta Title <span class="text-danger">*</span></label>
                                            <input type="text" id="meta_title" required name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Enter SEO meta title" value="{{ old('meta_title') }}">
                                            @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="meta_keywords">SEO Meta Keywords <span class="text-danger">*</span></label>
                                            <textarea id="meta_keywords" required name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Enter SEO meta keywords">{{ old('meta_keywords') }}</textarea>
                                            @error('meta_keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="meta_description">SEO Meta Description <span class="text-danger">*</span></label>
                                            <textarea id="meta_description" required name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Enter SEO meta description">{{ old('meta_description') }}</textarea>
                                            @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Details Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="font-weight-bold text-primary">
                                    <i class="fas fa-tags"></i> Blog Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Tags Input -->
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="tags">Tags <span class="text-danger">*</span></label>
                                            <input type="text" id="tags" required name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter tags separated by commas" value="{{ old('tags') }}">
                                            @error('tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Example: tag1, tag2, tag3</small>
                                        </div>
                                    </div>

                                    <!-- Blog Image -->
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="image">Blog Image <span class="text-danger">*</span></label>
                                            <input type="file" id="image" required name="image" class="form-control-file @error('image') is-invalid @enderror">
                                            @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Create Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
