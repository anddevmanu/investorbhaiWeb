@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        </div>

        @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit user</h6>
            </div>
            <div class="card-body">
                @error('id')
                    <div class="alert alert-danger">
                        Something went wrong!
                    </div>
                @enderror
                <form class="user" method="POST" action="{{ route("users.update", $user->id) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group grid-container">
                                <div class="grid-item">
                                    <label class="text-left">Name: </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name', $user->name) }}" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="grid-item">
                                    <label class="text-left">Phone: </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"  placeholder="Phone" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="grid-item">
                                    <label class="text-left">Role: </label>
                                    <select class="form-control @error('role') is-invalid @enderror" name="role">
                                        <option value="">Select role</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected="selected"' : '' }}>Admin</option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected="selected"' : '' }}>User</option>
                                        <option value="blog-editor" {{ old('role', $user->role) == 'blog-editor' ? 'selected="selected"' : '' }}>Blog Editor</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="grid-item">
                                    <label class="text-left">Status: </label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="">Select status</option>
                                        <option value="1" {{ old('status', $user->status) == '1' ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $user->status) == '0' ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{ route('user.list') }}" class="btn btn-dark">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .grid-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
@endsection
