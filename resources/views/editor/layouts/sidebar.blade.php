<div class="flex flex-col h-full p-6 space-y-6">
    <!-- Logo or Brand Name -->
    <div class="text-center text-2xl font-bold text-white mb-4">
        <a href="{{ route('editor.dashboard') }}">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i> Editor Panel
        </a>
    </div>

    @php
        $user = Auth::user();
    @endphp

    <!-- Navigation Links -->
    <ul class="flex flex-col space-y-6">
        <li>
            <a href="{{ route('editor.dashboard') }}"
                class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-tachometer pr-2" aria-hidden="true"></i> Dashboard
            </a>
        </li>

        <!-- Manage Questions Dropdown -->
        <li class="relative group">
            <a href="javascript:void(0)" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md"
                onclick="toggleDropdown('questionsDropdown')">
                <i class="fa fa-question pr-2" aria-hidden="true"></i> Manage Questions
                <i class="fa fa-caret-down pl-2"></i>
            </a>

            <!-- Dropdown Menu -->
            <ul id="questionsDropdown" class="hidden mt-2 pl-6 space-y-4 text-sm">
                <li>
                    <a href="{{ route('question.list') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-list pr-2"></i> All Questions
                    </a>
                </li>
                <li>
                    <a href="{{ route('question.list', ['userId' => $user->id]) }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-user pr-2"></i> My Questions
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.create') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-plus pr-2"></i> Create Question
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manage Category Dropdown -->
        <li class="relative group">
            <a href="javascript:void(0)" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md"
                onclick="toggleDropdown('categoryDropdown')">
                <i class="fa fa-folder pr-2" aria-hidden="true"></i> Manage Category
                <i class="fa fa-caret-down pl-2"></i>
            </a>

            <!-- Dropdown Menu -->
            <ul id="categoryDropdown" class="hidden mt-2 pl-6 space-y-4 text-sm">
                <li>
                    <a href="{{ route('category.list') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-list pr-2"></i> All Category
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.create') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-plus pr-2"></i> Create Category
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manage Blogs Dropdown -->
        <li class="relative group">
            <a href="javascript:void(0)" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md"
                onclick="toggleDropdown('blogsDropdown')">
                <i class="fa fa-book pr-2" aria-hidden="true"></i> Manage Blogs
                <i class="fa fa-caret-down pl-2"></i>
            </a>

            <!-- Dropdown Menu -->
            <ul id="blogsDropdown" class="hidden mt-2 pl-6 space-y-4 text-sm">
                <li>
                    <a href="{{ route('blog.list') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-list pr-2"></i> All Blogs
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.list', ['userId' => $user->id]) }}"
                        class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-user pr-2"></i> My Blogs
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.create') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">
                        <i class="fa fa-plus pr-2"></i> Create Blog
                    </a>
                </li>
            </ul>
        </li>

        <!-- Other Menu Items -->
        <li>
            <a href="" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-cogs pr-2" aria-hidden="true"></i> Settings
            </a>
        </li>
        <li>
            <a href="" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-user pr-2" aria-hidden="true"></i> Profile
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <div class="mt-auto">
        <a href="{{ route('logout') }}" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
            <i class="fa fa-sign-out pr-2" aria-hidden="true"></i> Logout
        </a>
    </div>
</div>

<!-- JavaScript for Dropdown Toggle -->
<script>
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('hidden');
    }
</script>
