<?php

if (isset($_GET['page'])) {
  $page = $_GET['page'];

  switch ($page) {
    case '':

    case 'home':
      file_exists('pages/home.php') ? include 'pages/home.php' : include '../pages/404.php';
      $title = 'Home';
      break;
    case 'obatread':
      file_exists('pages/obat/obatread.php') ? include 'pages/obat/obatread.php' : include '../pages/404.php';
      $title = 'Obat';
      break;
    case 'obatcreate':
      file_exists('pages/obat/obatcreate.php') ? include 'pages/obat/obatcreate.php' : include '../pages/404.php';
      $title = 'Obat';
      break;
    case 'obatupdate':
      file_exists('pages/obat/obatupdate.php') ? include 'pages/obat/obatupdate.php' : include '../pages/404.php';
      $title = 'Obat';
      break;
    case 'obatdelete':
      file_exists('pages/obat/obatdelete.php') ? include 'pages/obat/obatdelete.php' : include '../pages/404.php';
      $title = 'Obat';
      break;
    case 'obatdetail':
      file_exists('pages/obat/obatdetail.php') ? include 'pages/obat/obatdetail.php' : include '../pages/404.php';
      $title = 'Obat';
      break;
    case 'pelangganread':
      file_exists('pages/pelanggan/pelangganread.php') ? include 'pages/pelanggan/pelangganread.php' : include '../pages/404.php';
      $title = 'Pelanggan';
      break;
    case 'pelanggancreate':
      file_exists('pages/pelanggan/pelanggancreate.php') ? include 'pages/pelanggan/pelanggancreate.php' : include '../pages/404.php';
      $title = 'Pelanggan';
      break;
    case 'pelangganupdate':
      file_exists('pages/pelanggan/pelangganupdate.php') ? include 'pages/pelanggan/pelangganupdate.php' : include '../pages/404.php';
      $title = 'Pelanggan';
      break;
    case 'pelanggandelete':
      file_exists('pages/pelanggan/pelanggandelete.php') ? include 'pages/pelanggan/pelanggandelete.php' : include '../pages/404.php';
      $title = 'Pelanggan';
      break;
    case 'pelanggandetail':
      file_exists('pages/pelanggan/pelanggandetail.php') ? include 'pages/pelanggan/pelanggandetail.php' : include '../pages/404.php';
      $title = 'Pelanggan';
      break;
    case 'suplierread':
      file_exists('pages/suplier/suplierread.php') ? include 'pages/suplier/suplierread.php' : include '../pages/404.php';
      $title = 'Suplier';
      break;
    case 'supliercreate':
      file_exists('pages/suplier/supliercreate.php') ? include 'pages/suplier/supliercreate.php' : include '../pages/404.php';
      $title = 'Suplier';
      break;
    case 'suplierupdate':
      file_exists('pages/suplier/suplierupdate.php') ? include 'pages/suplier/suplierupdate.php' : include '../pages/404.php';
      $title = 'Suplier';
      break;
    case 'suplierdelete':
      file_exists('pages/suplier/suplierdelete.php') ? include 'pages/suplier/suplierdelete.php' : include '../pages/404.php';
      $title = 'Suplier';
      break;
    case 'suplierdetail':
      file_exists('pages/suplier/suplierdetail.php') ? include 'pages/suplier/suplierdetail.php' : include '../pages/404.php';
      $title = 'Suplier';
      break;
    case 'dokterread':
      file_exists('pages/dokter/dokterread.php') ? include 'pages/dokter/dokterread.php' : include '../pages/404.php';
      $title = 'Dokter';
      break;
    case 'doktercreate':
      file_exists('pages/dokter/doktercreate.php') ? include 'pages/dokter/doktercreate.php' : include '../pages/404.php';
      $title = 'Dokter';
      break;
    case 'dokterupdate':
      file_exists('pages/dokter/dokterupdate.php') ? include 'pages/dokter/dokterupdate.php' : include '../pages/404.php';
      $title = 'Dokter';
      break;
    case 'dokterdelete':
      file_exists('pages/dokter/dokterdelete.php') ? include 'pages/dokter/dokterdelete.php' : include '../pages/404.php';
      $title = 'Dokter';
      break;
    case 'dokterdetail':
      file_exists('pages/dokter/dokterdetail.php') ? include 'pages/dokter/dokterdetail.php' : include '../pages/404.php';
      $title = 'Dokter';
      break;
    case 'pembelianread':
      file_exists('pages/pembelian/pembelianread.php') ? include 'pages/pembelian/pembelianread.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'pembeliancreate':
      file_exists('pages/pembelian/pembeliancreate.php') ? include 'pages/pembelian/pembeliancreate.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'pembelianupdate':
      file_exists('pages/pembelian/pembelianupdate.php') ? include 'pages/pembelian/pembelianupdate.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'pembeliandelete':
      file_exists('pages/pembelian/pembeliandelete.php') ? include 'pages/pembelian/pembeliandelete.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'pembeliandetail':
      file_exists('pages/pembelian/pembeliandetail.php') ? include 'pages/pembelian/pembeliandetail.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'dopembeliancreate':
      file_exists('pages/pembelian/dopembeliancreate.php') ? include 'pages/pembelian/dopembeliancreate.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'dopembelianupdate':
      file_exists('pages/pembelian/dopembelianupdate.php') ? include 'pages/pembelian/dopembelianupdate.php' : include '../pages/404.php';
      $title = 'Pembelian';
      break;
    case 'stokread':
      file_exists('pages/stok/stokread.php') ? include 'pages/stok/stokread.php' : include '../pages/404.php';
      $title = 'Stok';
      break;
    case 'pelayananread':
      file_exists('pages/pelayanan/pelayananread.php') ? include 'pages/pelayanan/pelayananread.php' : include '../pages/404.php';
      $title = 'Pelayanan';
      break;
    case 'pelayanancreate':
      file_exists('pages/pelayanan/pelayanancreate.php') ? include 'pages/pelayanan/pelayanancreate.php' : include '../pages/404.php';
      $title = 'Pelayanan';
      break;
    case 'pelayananupdate':
      file_exists('pages/pelayanan/pelayananupdate.php') ? include 'pages/pelayanan/pelayananupdate.php' : include '../pages/404.php';
      $title = 'Pelayanan';
      break;
    case 'pelayanandelete':
      file_exists('pages/pelayanan/pelayanandelete.php') ? include 'pages/pelayanan/pelayanandelete.php' : include '../pages/404.php';
      $title = 'Pelayanan';
      break;
    case 'pelayanandetail':
      file_exists('pages/pelayanan/pelayanandetail.php') ? include 'pages/pelayanan/pelayanandetail.php' : include '../pages/404.php';
      $title = 'Pelayanan';
      break;

    case 'armadaread':
      file_exists('pages/armada/armadaread.php') ? include 'pages/armada/armadaread.php' : include '../pages/404.php';
      $title = 'Armada';
      break;
    case 'armadacreate':
      file_exists('pages/armada/armadacreate.php') ? include 'pages/armada/armadacreate.php' : include '../pages/404.php';
      $title = 'Armada';
      break;
    case 'armadaupdate':
      file_exists('pages/armada/armadaupdate.php') ? include 'pages/armada/armadaupdate.php' : include '../pages/404.php';
      $title = 'Armada';
      break;
    case 'armadadelete':
      file_exists('pages/armada/armadadelete.php') ? include 'pages/armada/armadadelete.php' : include '../pages/404.php';
      $title = 'Armada';
      break;
    case 'armadadetail':
      file_exists('pages/armada/armadadetail.php') ? include 'pages/armada/armadadetail.php' : include '../pages/404.php';
      $title = 'Armada';
      break;
    case 'karyawanread':
      file_exists('pages/karyawan/karyawanread.php') ? include 'pages/karyawan/karyawanread.php' : include '../pages/404.php';
      $title = 'Karyawan';
      break;
    case 'karyawancreate':
      file_exists('pages/karyawan/karyawancreate.php') ? include 'pages/karyawan/karyawancreate.php' : include '../pages/404.php';
      $title = 'Karyawan';
      break;
    case 'karyawanupdate':
      file_exists('pages/karyawan/karyawanupdate.php') ? include 'pages/karyawan/karyawanupdate.php' : include '../pages/404.php';
      $title = 'Karyawan';
      break;
    case 'karyawandelete':
      file_exists('pages/karyawan/karyawandelete.php') ? include 'pages/karyawan/karyawandelete.php' : include '../pages/404.php';
      $title = 'Karyawan';
      break;
    case 'karyawandetail':
      file_exists('pages/karyawan/karyawandetail.php') ? include 'pages/karyawan/karyawandetail.php' : include '../pages/404.php';
      $title = 'Karyawan';
      break;
    case 'rangepengajuaninsentif':
      file_exists('pages/rangepengajuaninsentif.php') ? include 'pages/rangepengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Pengajuan Insentif';
      break;
    case 'pengajuaninsentif':
      file_exists('pages/pengajuaninsentif.php') ? include 'pages/pengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Pengajuan Insentif';
      break;
    case 'detailpengajuaninsentif':
      file_exists('pages/detailpengajuaninsentif.php') ? include 'pages/detailpengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Pengajuan Insentif';
      break;
    case 'rangerekappengajuaninsentif':
      file_exists('pages/rangerekappengajuaninsentif.php') ? include 'pages/rangerekappengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Insentif';
      break;
    case 'rekappengajuaninsentif':
      file_exists('pages/rekappengajuaninsentif.php') ? include 'pages/rekappengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Insentif';
      break;
    case 'rekapdetailpengajuaninsentif':
      file_exists('pages/rekapdetailpengajuaninsentif.php') ? include 'pages/rekapdetailpengajuaninsentif.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Insentif';
      break;
    case 'rekapdetailpengajuanupah':
      file_exists('pages/rekapdetailpengajuanupah.php') ? include 'pages/rekapdetailpengajuanupah.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Upah';
      break;
    case 'rangepengajuanupah':
      file_exists('pages/rangepengajuanupah.php') ? include 'pages/rangepengajuanupah.php' : include '../pages/404.php';
      $title = 'Pengajuan Upah';
      break;
    case 'upahbelumdiajukan':
      file_exists('pages/upahbelumdiajukan.php') ? include 'pages/upahbelumdiajukan.php' : include '../pages/404.php';
      $title = 'Upah Belum Diajukan';
      break;
    case 'upahbelumdiajukandetail':
      file_exists('pages/upahbelumdiajukandetail.php') ? include 'pages/upahbelumdiajukandetail.php' : include '../pages/404.php';
      $title = 'Upah Belum Diajukan';
      break;
    case 'rangerekappengajuanupah':
      file_exists('pages/rangerekappengajuanupah.php') ? include 'pages/rangerekappengajuanupah.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Upah';
      break;
    case 'rekappengajuanupah':
      file_exists('pages/rekappengajuanupah.php') ? include 'pages/rekappengajuanupah.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Upah';
      break;
    case 'rekapdetailpengajuanupah':
      file_exists('pages/rekapdetailpengajuanupah.php') ? include 'pages/rekapdetailpengajuanupah.php' : include '../pages/404.php';
      $title = 'Rekap Pengajuan Upah';
      break;
    case 'rangerekapupah':
      file_exists('pages/rangerekapupah.php') ? include 'pages/rangerekapupah.php' : include '../pages/404.php';
      $title = 'Rekap Upah';
      break;
    case 'rekapupah':
      file_exists('pages/rekapupah.php') ? include 'pages/rekapupah.php' : include '../pages/404.php';
      $title = 'Rekap Upah';
      break;
    case 'rekapdetailupah':
      file_exists('pages/rekapdetailupah.php') ? include 'pages/rekapdetailupah.php' : include '../pages/404.php';
      $title = 'Rekap Upah';
      break;
    case 'rangerekapinsentif':
      file_exists('pages/rangerekapinsentif.php') ? include 'pages/rangerekapinsentif.php' : include '../pages/404.php';
      $title = 'Rekap Insentif';
      break;
    case 'rekapinsentif':
      file_exists('pages/rekapinsentif.php') ? include 'pages/rekapinsentif.php' : include '../pages/404.php';
      $title = 'Rekap Insentif';
      break;
    case 'rekapdetailinsentif':
      file_exists('pages/rekapdetailinsentif.php') ? include 'pages/rekapdetailinsentif.php' : include '../pages/404.php';
      $title = 'Rekap Insentif';
      break;
    case 'rangerekapgaji':
      file_exists('pages/rangerekapgaji.php') ? include 'pages/rangerekapgaji.php' : include '../pages/404.php';
      $title = 'Rekap Gaji';
      break;
    case 'rekapgaji':
      file_exists('pages/rekapgaji.php') ? include 'pages/rekapgaji.php' : include '../pages/404.php';
      $title = 'Rekap Gaji';
      break;
    case 'rekapdetailgaji':
      file_exists('pages/rekapdetailgaji.php') ? include 'pages/rekapdetailgaji.php' : include '../pages/404.php';
      $title = 'Rekap Gaji';
      break;
    case 'rangerekapdistribusi':
      file_exists('pages/rangerekapdistribusi.php') ? include 'pages/rangerekapdistribusi.php' : include '../pages/404.php';
      $title = 'Rekap Distribusi';
      break;
    case 'rekapdistribusi':
      file_exists('pages/rekapdistribusi.php') ? include 'pages/rekapdistribusi.php' : include '../pages/404.php';
      $title = 'Rekap Distribusi';
      break;
    case 'detaildistribusi':
      file_exists('pages/detaildistribusi.php') ? include 'pages/detaildistribusi.php' : include '../pages/404.php';
      $title = 'Distribusi';
      break;
    case 'rangeprestasikaryawan':
      file_exists('pages/prestasi/rangeprestasikaryawan.php') ? include 'pages/prestasi/rangeprestasikaryawan.php' : include '../pages/404.php';
      $title = 'Prestasi';
      break;
    case 'prestasikaryawan':
      file_exists('pages/prestasi/prestasikaryawan.php') ? include 'pages/prestasi/prestasikaryawan.php' : include '../pages/404.php';
      $title = 'Prestasi';
      break;
    case 'prestasikaryawandetail':
      file_exists('pages/prestasi/prestasikaryawandetail.php') ? include 'pages/prestasi/prestasikaryawandetail.php' : include '../pages/404.php';
      $title = 'Prestasi';
      break;
    case 'cetakupah':
      file_exists('pages/cetakupah.php') ? include 'pages/cetakupah.php' : include '../pages/404.php';
      $title = 'Cetak Upah';
      break;
    case 'cetakinsentif':
      file_exists('pages/cetakinsentif.php') ? include 'pages/cetakinsentif.php' : include '../pages/404.php';
      $title = 'Cetak Insentif';
      break;
    case 'ubahpassword':
      file_exists('../pages/ubahpassword.php') ? include '../pages/ubahpassword.php' : include '../pages/404.php';
      $title = 'Ubah Password';
      break;
    case 'gantifoto':
      file_exists('../pages/gantifoto.php') ? include '../pages/gantifoto.php' : include '../pages/404.php';
      $title = 'Ubah Foto';
      break;
    case 'gantiprofil':
      file_exists('../pages/gantiprofil.php') ? include '../pages/gantiprofil.php' : include '../pages/404.php';
      $title = 'Ubah profil';
      break;
    default:
      include '../pages/404.php';
      $title = '404 Halaman Tidak Ditemukan';
  }
} else {
  include 'pages/home.php';
  $title = 'Home';
}
