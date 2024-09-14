@extends('editor.layouts.master')

@section('title')
    <title>Edit Blog Category - Investorbhai</title>
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Blog Category</h1>
            <a href="{{ route('category.list') }}" class="btn btn-primary btn-sm flex items-center">
                <i class="fas fa-list fa-sm text-white-50"></i> Category List
            </a>
        </div>

        @include('admin.layouts.message')

        <!-- Category Form -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- This method is required for updating -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category Name -->
                    <div>
                        <label for="category_name" class="block text-gray-700">Category Name <span class="text-red-500">*</span></label>
                        <input type="text" id="category_name" required name="category_name"
                            class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('category_name') border-red-500 @enderror"
                            placeholder="Enter category name" value="{{ old('category_name', $category->category_name) }}">
                        @error('category_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Category Description -->
                    <div>
                        <label for="category_description" class="block text-gray-700">Category Description <span class="text-red-500">*</span></label>
                        <input type="text" id="category_description" required name="category_description"
                            class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('category_description') border-red-500 @enderror"
                            placeholder="Enter category description" value="{{ old('category_description', $category->category_description) }}">
                        @error('category_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Category Status -->
                    <div>
                        <label for="status" class="block text-gray-700">Category Status <span class="text-red-500">*</span></label>
                        <select id="status" required name="status" class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-check"></i> Update Category
                    </button>
                </div>
            </form>
        </div>

    @endsection
