<nav class="bg-white shadow-lg fixed w-full top-0 z-10 px-8 py-6">
    @php
        $user = Auth::user();
    @endphp
    <div class="container mx-auto flex justify-between items-center">
        <!-- Left Section: Logo -->
        <a href="{{route('home')}}" class="flex items-center">
            <img src="{{ asset('frontend/img/logo/logo5.png') }}" alt="logo" class="h-12">
        </a>

        <!-- Center Section: Navigation Links (hidden on mobile) -->
        <ul class="hidden lg:flex space-x-8 text-lg font-medium">
            <li><a href="{{route('home')}}" class="nav-link hover:text-blue-500 {{ request()->is('/') ? 'text-blue-500' : '' }}">Home</a></li>
            <li><a href="{{route('about')}}" class="nav-link hover:text-blue-500 {{ request()->is('about') ? 'text-blue-500' : '' }}">About</a></li>
            <li><a href="{{route('contact')}}" class="nav-link hover:text-blue-500 {{ request()->is('contact') ? 'text-blue-500' : '' }}">Contact</a></li>
            <li><a href="{{ route('home.blog.list') }}" class="nav-link hover:text-blue-500 {{ request()->is('blog') ? 'text-blue-500' : '' }}">Blog</a></li>
        </ul>

        <!-- Hamburger Button for Mobile -->
        <button id="hamburger-btn" class="lg:hidden block focus:outline-none">
            <i class="fa fa-bars text-2xl"></i>
        </button>

        <!-- Right Section: Search and Auth Links -->
        <div class="hidden lg:flex items-center space-x-4">
            <!-- Search Bar -->
            <form class="flex items-center border rounded overflow-hidden" method="GET" action="{{ route('search') }}">
                <input type="search" name="keyword" placeholder="Search" class="p-2 outline-none" value="{{ request()->get('keyword') }}" />
                <button class="bg-blue-500 text-white px-4 py-2" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Auth Links -->
            @auth
            <div class="relative">
                <button id="profile-menu-button" class="flex items-center space-x-2 text-gray-800">
                    <img src="{{ auth()->user()->profile_img ? auth()->user()->profile_img : asset('frontend/img/default-profile.png') }}" class="rounded-full w-10 h-10" alt="{{ auth()->user()->name }}" />
                    <span>{{ auth()->user()->name }}</span>
                </button>
                <div id="profile-menu" class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg hidden">
                    @if(auth()->user()->role === 'user')
                    <a href="{{route('profile.edit')}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="{{route('change.password')}}" class="block px-4 py-2 hover:bg-gray-100">Change Password</a>
                    <a href="{{route('question.list', ['userId' => $user->id])}}" class="block px-4 py-2 hover:bg-gray-100">My Questions</a>
                    @elseif(auth()->user()->role === 'editor')
                    <a href="" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="" class="block px-4 py-2 hover:bg-gray-100">Change Password</a>
                    <a href="" class="block px-4 py-2 hover:bg-gray-100">Blogs</a>
                    @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                    <a href="{{route('profile.edit')}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    @endif
                    <div class="border-t"></div>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign In</a>
            <a href="{{ route('register') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign Up</a>
            @endguest
        </div>
    </div>
</nav>
{{-- NAVBAR END --}}

{{-- SIDEBAR FOR MOBILE START --}}
<div id="sidebar" class="fixed top-0 right-0 w-64 bg-white shadow-lg h-full z-20 transform translate-x-full transition-transform">
    <div class="flex justify-between items-center p-4 bg-gray-100">
        <span class="text-xl font-semibold">
            <img src="{{ asset('frontend/img/logo/logo5.png') }}" alt="logo" class="h-8">
        </span>
        <button id="close-sidebar" class="text-2xl">&times;</button>
    </div>
    <div class="p-4">
        <!-- Mobile role-based links -->
        <ul class="space-y-4">
            <li><a href="{{route('home')}}" class="hover:text-blue-500">Home</a></li>
            <li><a href="{{route('about')}}" class="hover:text-blue-500">About</a></li>
            <li><a href="{{route('contact')}}" class="hover:text-blue-500">Contact</a></li>
            <li><a href="{{ route('home.blog.list') }}" class="hover:text-blue-500">Blog</a></li>
            @auth
            @if(auth()->user()->role === 'editor')
            <li><a href="/editor/dashboard" class="hover:text-blue-500">Editor Dashboard</a></li>
            <li><a href="/editor/manage" class="hover:text-blue-500">Manage Content</a></li>
            @elseif(auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-500">Admin Dashboard</a></li>
            @endif
            @endauth
        </ul>
    </div>
</div>
{{-- SIDEBAR FOR MOBILE END --}}
