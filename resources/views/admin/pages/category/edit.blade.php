@extends('admin.layouts.master')

@section('title')
    <title>Edit Category - Investorbhai</title>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <a href="{{ route('category.list') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-list fa-sm text-white-50"></i> Category List
            </a>
        </div>

        @include('admin.layouts.message')

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Category Name -->
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" id="category_name" name="category_name"
                                    class="form-control @error('category_name') is-invalid @enderror"
                                    placeholder="Enter category name" value="{{ old('category_name', $category->category_name) }}" />
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_description">Category Description</label>
                                <x-ckeditor id="category_description" name="category_description" value="{{ old('category_description', $category->category_description) }}" />
                                @error('category_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
