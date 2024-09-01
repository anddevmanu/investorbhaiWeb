<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <img src="/img/small.png" alt="AM" width="30" />
        </div> --}}
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('backend/img/investorbhai_logo.png') }}" alt="Ask Me Logo" width="140" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <li class="nav-item {{ (request()->is('users*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.list') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>

    <li class="nav-item ">
        <a href="{{ route('question.create') }}" class="nav-link" href="">
            <i class="fas fa-fw fa-question"></i>
            <span>Create Question</span></a>
    </li>

    {{-- <li class="nav-item ">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-file-import li"></i>
            <span>Import Questions</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
