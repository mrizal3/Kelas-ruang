<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            @if (auth()->user() != null)
            @if (auth()->user()->level == 0)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown {{ active_class(getUri(2), 'fakultas').active_class(getUri(2), 'ruang').active_class(getUri(2), 'matkul').active_class(getUri(2), 'kelas') }}">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ active_class(getUri(2), 'fakultas') }}"><a href="{{ route('fakultas.index') }}" class="nav-link">Fakultas</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'ruang') }}"><a href="{{ route('ruang.index') }}" class="nav-link">Ruang</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'matkul') }}"><a href="{{ route('matkul.index') }}" class="nav-link">Mata Kuliah</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'kelas') }}"><a href="{{ route('kelas.index') }}" class="nav-link">Kelas</a></li>
                </ul>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'barang') }}">
                <a href="{{ url('admin/barang') }}" class="nav-link"><i class="fas fa-shopping-bag"></i><span>Barang</span></a>
            </li>
            <li class="nav-item dropdown {{ active_class(getUri(2), 'user'). active_class(getUri(2), 'jabatan').active_class(getUri(2), 'dosen') }}">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="fas fa-users"></i><span>Management User</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ active_class(getUri(2), 'jabatan') }}"><a href="{{ url('admin/jabatan') }}" class="nav-link">Jabatan</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'user') }}"><a href="{{ url('admin/user') }}" class="nav-link">User</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'dosen') }}"><a href="{{ url('admin/dosen') }}" class="nav-link">Dosen</a></li>
                </ul>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'jadwal') }}">
                <a href="{{ url('admin/jadwal') }}" class="nav-link"><i class="fas fa-book"></i><span>Jadwal Mata Kuliah</span></a>
            </li>
            {{-- <li class="nav-item {{ active_class(getUri(2), 'peminjaman-ruang') }}">
                <a href="{{ url('admin/peminjaman-ruang') }}" class="nav-link"><i class="fas fa-school"></i><span>Peminjaman Ruang</span></a>
            </li> --}}
            @elseif(auth()->user()->level == 1)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('akademik/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'pengajuan') }}">
                <a href="{{ url('akademik/pengajuan') }}" class="nav-link"><i class="fab fa-elementor"></i><span>Pengajuan</span></a>
            </li>
            @elseif(auth()->user()->level == 2)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('peminjam/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'pengajuan') }}">
                <a href="{{ url('peminjam/pengajuan') }}" class="nav-link"><i class="fab fa-elementor"></i><span>Pengajuan</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'arsip-data') }}">
                <a href="{{ url('peminjam/arsip-data') }}" class="nav-link"><i class="fas fa-book"></i><span>Arsip Data</span></a>
            </li>
            @elseif(auth()->user() == null)
            
            @endif
            @else
            <li class="nav-item {{ active_class(getUri(1), '') }}">
                <a href="{{ url('') }}" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(1), 'jadwal') }}">
                <a href="{{ url('jadwal') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Jadwal Mata Kuliah</span></a>
            </li>
            @endif
        </ul>
    </div>
</nav>
<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            @if (auth()->user() != null)
            @if (auth()->user()->level == 0)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown {{ active_class(getUri(2), 'fakultas').active_class(getUri(2), 'ruang').active_class(getUri(2), 'matkul').active_class(getUri(2), 'kelas') }}">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ active_class(getUri(2), 'fakultas') }}"><a href="{{ route('fakultas.index') }}" class="nav-link">Fakultas</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'ruang') }}"><a href="{{ route('ruang.index') }}" class="nav-link">Ruang</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'matkul') }}"><a href="{{ route('matkul.index') }}" class="nav-link">Mata Kuliah</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'kelas') }}"><a href="{{ route('kelas.index') }}" class="nav-link">Kelas</a></li>
                </ul>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'barang') }}">
                <a href="{{ url('admin/barang') }}" class="nav-link"><i class="fas fa-shopping-bag"></i><span>Barang</span></a>
            </li>
            <li class="nav-item dropdown {{ active_class(getUri(2), 'user'). active_class(getUri(2), 'jabatan').active_class(getUri(2), 'dosen') }}">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="fas fa-users"></i><span>Management User</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ active_class(getUri(2), 'jabatan') }}"><a href="{{ url('admin/jabatan') }}" class="nav-link">Jabatan</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'user') }}"><a href="{{ url('admin/user') }}" class="nav-link">User</a></li>
                    <li class="nav-item {{ active_class(getUri(2), 'dosen') }}"><a href="{{ url('admin/dosen') }}" class="nav-link">Dosen</a></li>
                </ul>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'jadwal') }}">
                <a href="{{ url('admin/jadwal') }}" class="nav-link"><i class="fas fa-book"></i><span>Jadwal Mata Kuliah</span></a>
            </li>
            {{-- <li class="nav-item {{ active_class(getUri(2), 'peminjaman-ruang') }}">
                <a href="{{ url('admin/peminjaman-ruang') }}" class="nav-link"><i class="fas fa-school"></i><span>Peminjaman Ruang</span></a>
            </li> --}}
            @elseif(auth()->user()->level == 1)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('akademik/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'pengajuan') }}">
                <a href="{{ url('akademik/pengajuan') }}" class="nav-link"><i class="fab fa-elementor"></i><span>Pengajuan</span></a>
            </li>
            @elseif(auth()->user()->level == 2)
            <li class="nav-item {{ active_class(getUri(2), 'dashboard') }}">
                <a href="{{ url('peminjam/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'pengajuan') }}">
                <a href="{{ url('peminjam/pengajuan') }}" class="nav-link"><i class="fab fa-elementor"></i><span>Pengajuan</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(2), 'arsip-data') }}">
                <a href="{{ url('peminjam/arsip-data') }}" class="nav-link"><i class="fas fa-book"></i><span>Arsip Data</span></a>
            </li>
            @elseif(auth()->user() == null)
            
            @endif
            @else
            <li class="nav-item {{ active_class(getUri(1), '') }}">
                <a href="{{ url('') }}" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            <li class="nav-item {{ active_class(getUri(1), 'jadwal') }}">
                <a href="{{ url('jadwal') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Jadwal Mata Kuliah</span></a>
            </li>
            @endif
        </ul>
    </div>
</nav>
