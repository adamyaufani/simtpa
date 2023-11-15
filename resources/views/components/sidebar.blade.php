<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PanDa TPA <sup></sup></div>
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
        Event
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.training_index') }}">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Daftar Event</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order_index') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Order</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.training_participants') }}">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Peserta Event</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.cart_index') }}">
            <i class="fas fa-fw fa-cart-shopping"></i>
            <span>Keranjang</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Pengguna
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user_index') }}">
            <i class="fas fa-fw fa-mosque"></i>
            <span>Daftar TPA</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.agreement_index') }}">
            <i class="fas fa-fw fa-signature"></i>
            <span>Persetujuan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Heading -->
    <div class="sidebar-heading">
        Surat
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.letter_index') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Daftar Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.create_letter') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Buat Surat Baru</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        TPA
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.student_index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Santri</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.staff_index') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Staff</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    {{-- <div class="sidebar-heading">
        Pengaturan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.certificate_setting_index') }}">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Pengaturan Sertifikat</span>
    </a>
    </li> --}}

    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
