@extends('user.layouts.authenticated.master')

@section('title')
    <title>Update Password - InvestorBhai</title>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">My Profile</h1>

            <!-- Profile Form -->
            <form action="{{ route('update.password') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Profile Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="password" name="current_password" id="current_password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none
                            focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email (Read-Only) -->
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="new_password" id="new_password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none
                            focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('new_password') is-invalid @enderror">
                        @error('new_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none
                            focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('new_password_confirmation') is-invalid @enderror">
                        @error('new_password_confirmation')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
