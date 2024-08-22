
    <nav class="bg-white shadow-lg fixed w-full top-0 z-10 px-8 py-6">

        <div class="container mx-auto flex justify-between items-center">
            <!-- Left Section: Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('frontend/img/logo/logo5.png') }}" alt="logo" class="h-12">
            </a>

            <!-- Center Section: Navigation Links -->
            <ul class="flex space-x-8 text-lg font-medium">
                <li><a href="/" class="nav-link hover:text-blue-500">Home</a></li>
                <li><a href="/about" class="nav-link hover:text-blue-500">About</a></li>
                <li><a href="/contact" class="nav-link hover:text-blue-500">Contact</a></li>
            </ul>

            <!-- Right Section: Search Bar and Auth Links -->
            <div class="flex items-center space-x-4">
                <form class="flex items-center border rounded overflow-hidden" method="GET" onsubmit="globalSearch(event)">
                    <input type="search" placeholder="Search" aria-label="Search" class="p-2 outline-none">
                    <button class="bg-blue-500 text-white px-4 py-2" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <!-- Auth Links -->
                <a href="/login" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign In</a>
                <a href="{{ route('register') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">Sign Up</a>
            </div>
        </div>
    </nav>


