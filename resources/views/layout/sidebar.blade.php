<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/apotek" class="brand-link">
      <img src="{{ asset('') }}assets/dist/img/klinik.png" class="brand-image img-circle elevation-3 bg-white" >
      <span class="brand-text font-weight-light">Klinik Sehat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('') }}assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
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

      @can('superadmin')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="/apotek" class="nav-link">
                <i class="bi bi-house-heart"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/pasien/index" class="nav-link">
                <i class="bi bi-person-hearts"></i>
                <p>Pasien <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dashboard/pendaftaran" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekam/antrian-pasien-admin" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Antrian Pasien</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pasien/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pasien</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekam/diagnosa" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Diagnosa Pasien</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="/dokter_page/index" class="nav-link">
                <i class="bi bi-person-heart"></i>
                <p>Data Dokter <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dokter_page/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dokter</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/jadwal/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jadwal Dokter</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/poli/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Poli</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tindakan</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="/obat_page/total_stok" class="nav-link">
                <i class="bi bi-capsule"></i>
                <p>Farmasi <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/obat_page/total_stok" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Obat</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/jenis_obat/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jenis Obat</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-credit-card-2-back"></i>
                <p>Data Pembayaran</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-gear"></i>
                <p>Setting<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/user_page/index" class="nav-link">
                    <i class="bi bi-person-vcard"></i>
                    <p>Data User</i></p>
                  </a>
                </li>
              </ul>
            </li>
            </ul>
        </nav>   
      @endcan

      @can('admin')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
           
            
            
            <li class="nav-item">
              <a href="/apotek" class="nav-link">
                <i class="bi bi-house-heart"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/pasien/index" class="nav-link">
                <i class="bi bi-person-hearts"></i>
                <p>Pasien <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dashboard/pendaftaran" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/rekam/antrian-pasien-admin" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Antrian Pasien</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/pasien/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pasien</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="/dokter_page/index" class="nav-link">
                <i class="bi bi-person-heart"></i>
                <p>Data Dokter <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dokter_page/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dokter</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/jadwal/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jadwal Dokter</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/poli/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Poli</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="/obat_page/total_stok" class="nav-link">
                <i class="bi bi-capsule"></i>
                <p>Farmasi <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/obat_page/total_stok" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Obat</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/jenis_obat/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jenis Obat</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-credit-card-2-back"></i>
                <p>Data Pembayaran</p>
              </a>
            </li>
          </ul>
        </nav>           
      @endcan

      @can('apotek')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/apotek" class="nav-link">
                <i class="bi bi-house-heart"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/obat_page/total_stok" class="nav-link">
                <i class="bi bi-capsule"></i>
                <p>Farmasi <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/obat_page/total_stok" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Obat</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/jenis_obat/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jenis Obat</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav> 
      @endcan
    </div>
  </aside>