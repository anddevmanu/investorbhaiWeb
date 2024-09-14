@extends('editor.layouts.master')

@section('title')
    <title>Edit Blog - InvestorBhai</title>
@endsection

@section('content')
<div class="container mx-auto px-4">
    <!-- Page Heading -->
    <div class="flex justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Blog</h1>
        <a href="{{ route('blog.list') }}" class="btn btn-primary btn-sm flex items-center">
            <i class="fas fa-list fa-sm text-white-50"></i> Blog List
        </a>
    </div>

    @include('admin.layouts.message')

    <!-- Blog Form -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Use the PUT method for updating the blog -->
        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Add PUT method for update -->

            <!-- Blog Information Section -->
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-2">
                    <i class="fas fa-info-circle"></i> Blog Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Blog Title -->
                    <div>
                        <label for="title" class="block text-gray-700">Blog Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" required name="title" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('title') border-red-500 @enderror" placeholder="Enter your blog title" value="{{ old('title', $blog->title) }}">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-gray-700">Category <span class="text-red-500">*</span></label>
                        <select id="category" required name="category" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('category') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Blog Content -->
                <div class="mt-4">
                    <label for="description" class="block text-gray-700">Blog Content <span class="text-red-500">*</span></label>
                    <x-ckeditor id="description" name="description" required value="{{ old('description', $blog->description) }}" />
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- SEO Section -->
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-2">
                    <i class="fas fa-search"></i> SEO Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- SEO Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-gray-700">SEO Meta Title <span class="text-red-500">*</span></label>
                        <input type="text" id="meta_title" required name="meta_title" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('meta_title') border-red-500 @enderror" placeholder="Enter SEO meta title" value="{{ old('meta_title', $blog->seo->meta_title) }}">
                        @error('meta_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Meta Keywords -->
                    <div>
                        <label for="meta_keywords" class="block text-gray-700">SEO Meta Keywords <span class="text-red-500">*</span></label>
                        <textarea id="meta_keywords" required name="meta_keywords" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('meta_keywords') border-red-500 @enderror" placeholder="Enter SEO meta keywords">{{ old('meta_keywords', $blog->seo->meta_keywords) }}</textarea>
                        @error('meta_keywords')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO Meta Description -->
                <div class="mt-4">
                    <label for="meta_description" class="block text-gray-700">SEO Meta Description <span class="text-red-500">*</span></label>
                    <textarea id="meta_description" required name="meta_description" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('meta_description') border-red-500 @enderror" placeholder="Enter SEO meta description">{{ old('meta_description', $blog->seo->meta_description) }}</textarea>
                    @error('meta_description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Blog Details Section -->
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-2">
                    <i class="fas fa-tags"></i> Blog Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tags Input -->
                    <div>
                        <label for="tags" class="block text-gray-700">Tags <span class="text-red-500">*</span></label>
                        <input type="text" id="tags" required name="tags" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('tags') border-red-500 @enderror" placeholder="Enter tags separated by commas" value="{{ old('tags', $blog->tags) }}">
                        @error('tags')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500">Example: tag1, tag2, tag3</small>
                    </div>

                    <!-- Blog Image -->
                    <div>
                        <label for="image" class="block text-gray-700">Blog Image <span class="text-red-500">*</span></label>
                        <input type="file" id="image" name="image" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('image') border-red-500 @enderror">
                        @if($blog->image)
                            <img src="{{ asset( $blog->image) }}" alt="Blog Image" class="mt-2 w-32">
                        @endif
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-check"></i> Update Blog
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
