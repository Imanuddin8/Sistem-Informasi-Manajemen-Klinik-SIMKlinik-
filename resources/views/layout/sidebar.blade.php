<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Klinik MAN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (auth()->user()->role == 'staff')
        <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="fas fa-fw fa-people-group"></i>
                <span>Antrian</span>
            </a>
        </li>

        <!-- Nav Item - Registrasi -->
        <li class="nav-item {{ request()->routeIs('registrasi.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('registrasi.index') }}">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Registrasi</span>
            </a>
        </li>
        <!-- Nav Item - Pasien -->
        <li class="nav-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Pasien</span>
            </a>
        </li>
        <!-- Nav Item - Laporan -->
        <li class="nav-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li>
    @endif

    @if (auth()->user()->role == 'admin')
        <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li>
    @endif

    @if (auth()->user()->role == 'dokter')
        <!-- Nav Item - Dokter -->
        <li class="nav-item {{ request()->routeIs('dokter.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dokter.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Pasien</span>
            </a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
