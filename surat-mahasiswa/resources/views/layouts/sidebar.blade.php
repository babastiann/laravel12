<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/LogoSidebar.png') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="40" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            @if(Auth::check())
                @if(Auth::user()->userable_type === 'App\Models\Mahasiswa')
                    @include('mahasiswa.sidebar') <!-- Sidebar untuk mahasiswa -->
                @elseif(Auth::user()->userable_type === 'App\Models\Kaprodi')
                    @include('kaprodi.sidebar') <!-- Sidebar untuk Kaprodi -->
                @elseif(Auth::user()->userable_type === 'App\Models\Karyawan')
                    @include('karyawan.sidebar') <!-- Sidebar untuk Karyawan -->
                @else
                    <p>Role tidak dikenali: {{ Auth::user()->userable_type }}</p>
                @endif
            @endif
        </div>
    </div>
  </div>
  <!-- End Sidebar -->