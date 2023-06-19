<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
  <!-- Brand Logo -->
  <?php
  if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] == "Admin") {
      $indexurl = "admin" . "/";
    } else if ($_SESSION['level'] == "Owner") {
      $indexurl = "owner" . "/";
    } else if ($_SESSION['level'] == "Kasir") {
      $indexurl = "kasir" . "/";
    }
  }
  ?>
  <a href="/<?= $indexurl; ?>" class="brand-link">
    <img src="../images/logooo cropped resized compressed.png" alt="AMDK Amanah" class="brand-image">
    <span class="brand-text font-weight-light">Apotek Fatih</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-3">
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
      <ul class="nav nav-pills nav-sidebar flex-colum" data-widget="treeview" role="menu" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="?page=home" class='nav-link' id='home'>
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <?php
      if ($_SESSION['level'] == 'Admin') {
        ?>
          <li class="nav-item" id="pelayanan">
            <a href="?page=pelayananread" class="nav-link" id="link_pelayanan">
              <i class="nav-icon fas fa-hand"></i>
              <p>
                Pelayanan
              </p>
            </a>
          </li>
          <li class="nav-item" id="pembelian">
            <a href="?page=pembelianread" class="nav-link" id="link_pembelian">
              <i class="nav-icon fas fa-dollar"></i>
              <p>
                Pembelian
              </p>
            </a>
          </li>
          <li class="nav-item" id="stok">
            <a href="?page=stokread" class="nav-link" id="link_stok">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Stok Barang
              </p>
            </a>
          </li>
          <li class="nav-item" id='master_data'>
            <a href="#" class="nav-link" id='link_master_data'>
              <i class="fas fa-th nav-icon"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=obatread" class="nav-link" id='obat'><i class="far fa-circle nav-icon"></i>
                  <p>Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=suplierread" class="nav-link" id='suplier'><i class="far fa-circle nav-icon"></i>
                  <p>Suplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=pelangganread" class="nav-link" id="pelanggan"><i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=dokterread" class="nav-link" id="dokter"><i class="far fa-circle nav-icon"></i>
                  <p>Dokter</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else if ($_SESSION['level'] == "Kasir") {
        ?>
           <li class="nav-item" id="penjualan">
            <a href="?page=penjualanread" class="nav-link" id="link_penjualan">
              <i class="nav-icon fas fa-dollar"></i>
              <p>
                Penjualan
              </p>
            </a>
          </li>
           <li class="nav-item" id="stok">
            <a href="?page=stokread" class="nav-link" id="link_stok">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Stok Barang
              </p>
            </a>
          </li>
          <li class="nav-item" id='master_data'>
            <a href="#" class="nav-link" id='link_master_data'>
              <i class="fas fa-th nav-icon"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=obatread" class="nav-link" id='obat'><i class="far fa-circle nav-icon"></i>
                  <p>Obat</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else if ($_SESSION['level'] == "Owner") {
        ?>
          <li class="nav-item" id="stok">
            <a href="?page=stokread" class="nav-link" id="link_stok">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Stok Barang
              </p>
            </a>
          </li>
          <li class="nav-item" id='rekapitulasi_data'>
            <a href="#" class="nav-link" id='link_rekapitulasi_data'>
              <i class="nav-icon fas fa-book"></i>
              <p>
                Rekapitulasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=rangerekappembelian" class="nav-link" id='rekappembelian'><i class="far fa-circle nav-icon"></i>
                  <p>Rekap Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=rangerekappenjualan" class="nav-link" id='rekappenjualan'><i class="far fa-circle nav-icon"></i>
                  <p>Rekap Penjualan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item" id='master_data'>
            <a href="#" class="nav-link" id='link_master_data'>
              <i class="fas fa-th nav-icon"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=obatread" class="nav-link" id='obat'><i class="far fa-circle nav-icon"></i>
                  <p>Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=suplierread" class="nav-link" id='suplier'><i class="far fa-circle nav-icon"></i>
                  <p>Suplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=pelangganread" class="nav-link" id="pelanggan"><i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=dokterread" class="nav-link" id="dokter"><i class="far fa-circle nav-icon"></i>
                  <p>Dokter</p>
                </a>
              </li>
            </ul>
          </li>
        <?php }; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>