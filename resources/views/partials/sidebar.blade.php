<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">SIPEKIN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">Yaa</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav">
                <a href="{{ url('/') }}" class="nav-link" style="line-height: 1;">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav">
                <a href="{{ url('/employee') }}" class="nav-link" style="line-height: 1;">
                    <i class="fas fa-users"></i><span>Karyawan</span>
                </a>
            </li>
            <li class="nav">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-chart-bar"></i>
                    <span>Penilaian</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('/performance-appraisal/annual') }}"><span>Hasil
                                Kerja</span></a></li>

                    <li><a class="nav-link" href="{{ url('/performance-appraisal/probation') }}"><span>Masa
                                Percobaan</span></a></li>
                    <li><a class="nav-link"
                            href="{{ url('/performance-appraisal/recommendation') }}"><span>Rekomendasi</span></a></li>
                </ul>
            </li>
            <li class="nav">
                <a href="{{ url('/hasilPenilaian') }}" class="nav-link" style="line-height: 1;">
                    <i class="fas fa-clipboard"></i><span>Hasil Penilaian</span>
                </a>
            </li>
            @if (Auth::user()->role == 'Admin')
            <li class="nav">
                <a href="{{ url('/user') }}" class="nav-link" style="line-height: 1;">
                    <i class="fas fa-user"></i><span>User</span>
                </a>
            </li>

            @endif
        </ul>
    </aside>
</div>