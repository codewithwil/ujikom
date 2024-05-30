<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      @php
    $pengaturan = \App\Models\Pengaturan::first();
@endphp

<img src="{{ asset('storage/back/pengaturan/' . optional($pengaturan)->foto_perusahaan) }}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">{{ optional($pengaturan)->nama_perusahaan }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->foto_profile)
              <img src="{{ asset('storage/back/foto-profile/' . Auth::user()->foto_profile) }}" class="rounded-circle" alt="Foto Pengguna" >
          @else
              <img src="{{ asset('admin/img/profile.png') }}" alt="Foto Profil" class="rounded-circle" >
          @endif
        </div>
        <div class="info">
          @php
          $roles = Auth::user()->getRoleNames();
          $role = $roles->first();
          @endphp
          <a href="#" class="d-block">{{ Auth::user()->name }} | {{ $role }}</a>
        </div>
      </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="{{route('dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
            <li class="nav-item">
              <a href="{{route('saldo.index')}}" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Saldo</p>
              </a>
            </li>

  
            <li class="nav-header">Kelola Anggota</li>
            <li class="nav-item">
              <a href="{{route('anggota.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Anggota</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('simpananDebet.index')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('pinjamanKredit.index')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Pinjaman</p>
              </a>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                  Angsuran
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('angsuran.debet')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>debet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('angsuran.kredit')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>kredit</p>
                  </a>
                </li>
              </ul>
            </li>
  
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('laporan.simpanan')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>simpanan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('laporan.pinjaman')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>pinjaman</p>
                  </a>
                </li>
              </ul>
            </li>

          <li class="nav-header">Kelola pegawai</li>
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Pegawai</p>
            </a>
          </li>
          <li class="nav-header">Pengaturan</li>
          <li class="nav-item">
            <a href="{{route('pengaturan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>