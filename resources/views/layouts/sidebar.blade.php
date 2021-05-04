<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-dragon"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard <sup class="d-inline-block mt-2"><?= Auth::user()->role == 1 ? 'Reseller' : 'Admin' ?> </sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (Auth::user()->role != 'user')        
    <div class="sidebar-heading">
        User
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('user/reseller') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Reseller</span></a>
    </li>
    <hr class="sidebar-divider">
    @endif

    <div class="sidebar-heading">
        Order
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('order/add') }}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Add Order</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('order/receipt') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Receipt List</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Course
    </div>
    @if (Auth::user()->role != 'user') 
    <li class="nav-item">
        <a class="nav-link" href="{{ url('category') }}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Category List</span></a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ url('course') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Course List</span></a>
    </li>
    <hr class="sidebar-divider">
    {{-- Sales --}}
    {{-- <div class="sidebar-heading">
        Sales
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('sale/input_sale') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Input Sales</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('sale/set_sell_price') }}">
            <i class="fas fa-fw fa-sliders-h"></i>
            <span>Set Product</span></a>
    </li>
    <hr class="sidebar-divider"> --}}
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Utility
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('utility/upload_testimoni') }}">
            <i class="fas fa-fw fa-upload"></i>
            <span>Upload Testimoni</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('utility/reseller_marketing_kit') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Reseller Marketing Kit</span></a>
    </li>
    @if (Auth::user()->role != 'user') 
    <li class="nav-item">
        <a class="nav-link" href="{{ url('utility/import_csv_order_online') }}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>Import CSV Order Online</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('utility/import_resi') }}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>Import CSV Resi</span></a>
    </li>
    @endif
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/certificate') }}">
            <i class="fas fa-fw fa-atlas"></i>
            <span>Certificate</span></a>
    </li> --}}
    <hr class="sidebar-divider">
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Transaction
    </div> --}}
    {{-- item --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/reservation') }}">
            <i class="fas fa-fw fa-scroll"></i>
            <span>Reservation List</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/reservation/create') }}">
            <i class="fas fa-fw fa-scroll"></i>
            <span>Create Reservation</span></a>
    </li> --}}
    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->

    <!-- Heading -->

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
