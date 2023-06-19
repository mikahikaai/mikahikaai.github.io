<h1 style="padding-left: 10px; padding-top: 5px;">Halaman Admin</h1>

<?php
include_once "../partials/scriptdatatables.php";

if (isset($_SESSION['hasil_update_pw'])) {
  if ($_SESSION['hasil_update_pw']) {
?>
    <div id='hasil_update_pw'></div>
<?php
  }
  unset($_SESSION['hasil_update_pw']);
}
?>

<script>
  if ($('div#hasil_update_pw').length) {
    Swal.fire({
      title: 'Updated!',
      text: 'Password berhasil diubah',
      icon: 'success',
      confirmButtonText: 'OK'
    })
  }
</script>