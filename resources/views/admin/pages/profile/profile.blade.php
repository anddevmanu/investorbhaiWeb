@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
        </div>

        @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
            </div>
            <div class="card-body">
                @error('id')
                    <div class="alert alert-danger">
                        Something went wrong!
                    </div>
                @enderror
                <form class="user" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group grid-container">
                                <div class="grid-item">
                                    <label class="text-left">Name: </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Name" name="name" value="{{ old('name', $user->name) }}" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="grid-item">
                                    <label class="text-left">Phone: </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Phone" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="grid-item">
                                    <label class="text-left" for="profile_img">Profile Image: </label>
                                    <input type="file" class="form-control @error('profile_img') is-invalid @enderror"
                                        placeholder="Profile Image" name="profile_img"  id="profile_img"/>
                                    @error('profile_img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($user->profile_img)
                                        <img src="{{ asset($user->profile_img) }}" alt="Profile Image"
                                            class="mt-4 w-24 h-24 rounded-full">
                                    @endif
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
