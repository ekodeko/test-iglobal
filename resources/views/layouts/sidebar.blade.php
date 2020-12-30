<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Design Cube <sup>Test</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('dokter') }}">
            <i class="fas fa-fw fa-archway"></i>
            <span>Dokter</span></a>
    </li>
    @if (Auth::user()->role_id == 2)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/certificate') }}">
                <i class="fas fa-fw fa-atlas"></i>
                <span>Certificate</span></a>
        </li>
    @endif
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Transaction
    </div>
    {{-- item --}}
    @if (Auth::user()->getRole())
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/reservation') }}">
                <i class="fas fa-fw fa-scroll"></i>
                <span>Reservation List</span></a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/reservation/create') }}">
            <i class="fas fa-fw fa-scroll"></i>
            <span>Create Reservation</span></a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->

    <!-- Heading -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
