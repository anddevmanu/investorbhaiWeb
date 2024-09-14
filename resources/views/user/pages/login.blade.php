<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- TAILWINDCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}">
    <title>Investorbhai Login</title>
</head>

<body>
    <section class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-sm w-full">
            <!-- Session Status -->
            @if (!auth()->check())
                <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

                <!-- Display Error Message -->
                @if (session('error'))
                    <p class="text-red-500 text-center mb-4">{{ session('error') }}</p>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Enter your email" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Enter your password" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors duration-300">
                        Login
                    </button>
                </form>

                <hr class="my-6 border-gray-300" />

                <!-- Social Login Buttons -->
                <div class="space-y-4">
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300"
                        onclick="window.location.href='{{ url('login/github') }}'">
                        <i class="fa fa-github mr-2"></i> Sign in with Github
                    </button>

                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300"
                        onclick="window.location.href='{{ url('login/google') }}'">
                        <i class="fa fa-google mr-2"></i> Sign in with Google
                    </button>
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300"
                        onclick="window.location.href='{{ url('login/facebook') }}'">
                        <i class="fa fa-facebook mr-2"></i> Sign in with Facebook
                    </button>
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-300"
                        onclick="window.location.href='{{ url('login/twitter') }}'">
                        <i class="fa fa-twitter mr-2"></i> Sign in with Twitter
                    </button>
                </div>
            @else
                <!-- If User is Logged In -->
                <h1 class="text-center text-lg mt-4">Signed in as {{ auth()->user()->email }}</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-600 text-white py-2 mt-4 rounded-md hover:bg-red-700 transition-colors duration-300">
                        Sign out
                    </button>
                </form>
            @endif
        </div>
    </section>
</body>

</html>
