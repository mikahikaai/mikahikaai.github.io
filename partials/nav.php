<?php
$level = '';
if ($_SESSION['level'] == 'Admin') {
  $level = 'Admin';
} else if ($_SESSION['level'] == 'Owner') {
  $level = 'Owner';
} else if ($_SESSION['level'] == 'Kasir') {
  $level = 'Kasir';
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <table width="100%">
    <tr>
      <td align="center" style="font-weight: bold; font-size: 20px;"> >>> Selamat Datang Di Aplikasi Apotek Fatih</span> - Saat Ini Anda Login Sebagai <span style="color: red;"><?= $level ?></span>
        <<< </td>
    </tr>
  </table>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-gear"></i>
        <!-- <p>Pengaturan</p> -->
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item">Pengaturan Pengguna</span>
        <a href="?page=ubahpassword" class="dropdown-item">
          <i class="fas fa-key mr-2"></i> Ubah Password
        </a>
        <a href="/logout.php" class="dropdown-item" id="logout">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<script>
  $('a#logout').click(function(e) {
    e.preventDefault();
    var urlToRedirect = e.currentTarget.getAttribute('href');
    //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    Swal.fire({
      title: 'Yakin anda ingin logout?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = urlToRedirect;
      }
    })
  });
</script>