<nav class="bg-white shadow-lg fixed w-full top-0 z-10 px-8 py-6">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Left Section: Logo -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('frontend/img/logo/logo5.png') }}" alt="logo" class="h-12">
        </a>

        <!-- Center Section: Navigation Links -->
        <ul class="flex space-x-8 text-lg font-medium">
            <li><a href="/" class="nav-link hover:text-blue-500 {{ request()->is('/') ? 'text-blue-500' : '' }}">Home</a></li>
            <li><a href="/about" class="nav-link hover:text-blue-500 {{ request()->is('about') ? 'text-blue-500' : '' }}">About</a></li>
            <li><a href="/contact" class="nav-link hover:text-blue-500 {{ request()->is('contact') ? 'text-blue-500' : '' }}">Contact</a></li>
            <li><a href="{{route('blog')}}" class="nav-link hover:text-blue-500 {{ request()->is('blog') ? 'text-blue-500' : '' }}">Blog</a></li>

        </ul>

        <!-- Right Section: Search Bar and Auth Links -->
        <div class="flex items-center space-x-4">
            <form class="flex items-center border rounded overflow-hidden" method="GET" action="{{ route('search') }}">
                <input
                    type="search"
                    name="keyword"
                    placeholder="Search"
                    aria-label="Search"
                    class="p-2 outline-none"
                    value="{{ request()->get('keyword') }}"
                />
                <button class="bg-blue-500 text-white px-4 py-2" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Auth Links -->
            @auth
                <div class="relative">
                    <button id="profile-menu-button" class="flex items-center space-x-2 text-gray-800">
                        <img
                            src="{{ auth()->user()->profile_img ? asset(auth()->user()->profile_img ): asset('frontend/img/default-profile.png') }}"
                            class="rounded-full w-10 h-10"
                            alt="{{ auth()->user()->name }}"
                        />
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profile-menu" class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg hidden">
                        @if(auth()->user()->role === 'user')
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('user/profile') ? 'bg-gray-100' : '' }}">Profile</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('user/settings') ? 'bg-gray-100' : '' }}">Change Password</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('user/questions') ? 'bg-gray-100' : '' }}">My Questions</a>
                        @elseif(auth()->user()->role === 'editor')
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('editor/profile') ? 'bg-gray-100' : '' }}">Profile</a>
                            <a href="{{ route('editor.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('editor/dashboard') ? 'bg-gray-100' : '' }}">Dashboard</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('editor/change-password') ? 'bg-gray-100' : '' }}">Change Password</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('editor/questions') ? 'bg-gray-100' : '' }}">My Questions</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('editor/blogs') ? 'bg-gray-100' : '' }}">Blogs</a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="{{route('admin.dashboard')}}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/dashboard') ? 'bg-gray-100' : '' }}">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/profile') ? 'bg-gray-100' : '' }}">Profile</a>
                            <a href="" class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/change-password') ? 'bg-gray-100' : '' }}">Change Password</a>
                        @endif
                        <div class="border-t"></div>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <script>
                    document.getElementById('profile-menu-button').addEventListener('click', function() {
                        var menu = document.getElementById('profile-menu');
                        menu.classList.toggle('hidden');
                    });
                </script>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign In</a>
                <a href="{{ route('register') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign Up</a>
            @endguest
        </div>
    </div>
</nav>
