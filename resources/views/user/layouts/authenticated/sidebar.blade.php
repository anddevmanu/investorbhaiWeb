<div class="flex flex-col h-full p-6 space-y-6">
    <!-- Logo or Brand Name -->
    <div class="text-center text-2xl font-bold text-white mb-4">
        <a href="">
            <i class="fa fa-user-circle" aria-hidden="true"></i> User Panel
        </a>
    </div>

    @php
        $user = Auth::user();
    @endphp

    <!-- Navigation Links -->
    <ul class="flex flex-col space-y-6">
        <li>
            <a href="{{ route('profile.edit') }}"
                class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-tachometer pr-2" aria-hidden="true"></i> Dashboard
            </a>
        </li>

        <!-- My Questions -->
        <li>
            <a href="{{ route('question.list', ['userId' => $user->id]) }}"
                class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-question pr-2" aria-hidden="true"></i> My Questions
            </a>
        </li>

        <!-- Profile -->
        <li>
            <a href="" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-user pr-2" aria-hidden="true"></i> Profile
            </a>
        </li>

        <!-- Change Password -->
        <li>
            <a href="" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-lock pr-2" aria-hidden="true"></i> Change Password
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a href="" class="flex items-center text-white hover:bg-gray-700 p-2 rounded-md">
                <i class="fa fa-cogs pr-2" aria-hidden="true"></i> Settings
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
