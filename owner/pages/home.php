<!-- Content Header (Page header) -->
<?php
$database = new Database;
$db = $database->getConnection();

$tahun = date('Y');
$tanggal_awal = date_create($tahun . '-01-01')->setTime(0, 0, 0);
$tanggal_akhir = date_create($tahun . '-12-31')->setTime(23, 59, 59);

$arrayChartPembelian = [];
for ($i = 1; $i <= 12; $i++) {
  $selectChartPembelian = "SELECT MONTH(tgl_pembelian), SUM(jumlah*harga) total_pembelian FROM pembelian
  WHERE MONTH(tgl_pembelian) = ? AND YEAR(tgl_pembelian) = ?
  GROUP BY MONTH(tgl_pembelian)";
  $stmtChartPembelian = $db->prepare($selectChartPembelian);
  $stmtChartPembelian->bindParam(1, $i);
  $stmtChartPembelian->bindParam(2, $tahun);
  $stmtChartPembelian->execute();
  $rowChartPembelian = $stmtChartPembelian->fetch(PDO::FETCH_ASSOC);
  if ($stmtChartPembelian->rowCount() == 0) {
    array_push($arrayChartPembelian, 0);
  } else {
    array_push($arrayChartPembelian, (int) $rowChartPembelian['total_pembelian']);
  }
}

$arrayChartPenjualan = [];
for ($i = 1; $i <= 12; $i++) {
  $selectChartPenjualan = "SELECT MONTH(tgl_penjualan), SUM(jumlah_obat*harga_jual) total_penjualan FROM penjualan p
  LEFT JOIN obat o ON p.id_obat = o.id_obat
  WHERE MONTH(tgl_penjualan) = ? AND YEAR(tgl_penjualan) = ?
  GROUP BY MONTH(tgl_penjualan)";
  $stmtChartPenjualan = $db->prepare($selectChartPenjualan);
  $stmtChartPenjualan->bindParam(1, $i);
  $stmtChartPenjualan->bindParam(2, $tahun);
  $stmtChartPenjualan->execute();
  $rowChartPenjualan = $stmtChartPenjualan->fetch(PDO::FETCH_ASSOC);
  if ($stmtChartPenjualan->rowCount() == 0) {
    array_push($arrayChartPenjualan, 0);
  } else {
    array_push($arrayChartPenjualan, (int) $rowChartPenjualan['total_penjualan']);
  }
}

if (isset($_SESSION['hasil_update_pw'])) {
  if ($_SESSION['hasil_update_pw']) {
?>
    <div id='hasil_update_pw'></div>
  <?php
  }
  unset($_SESSION['hasil_update_pw']);
}

if (isset($_SESSION['login_sukses'])) {
  if ($_SESSION['login_sukses']) {
  ?>
    <div id='login_sukses'></div>
<?php
  }
  unset($_SESSION['login_sukses']);
}



?>

<!-- Main content -->
<div class="content pt-3">
  <div class="container-fluid">
    <!-- <h3># Rangkuman Informasi (Tahun <?= date('Y') ?>)</h3> -->
    
    <!-- /.container-fluid -->
    <div class="row">
      <div class="col-md-6">
        <h3 class="mb-3"># Data Grafik Pembelian Tahun <?= date('Y'); ?> </h3>
        <canvas id="myChart"></canvas>
      </div>
      <div class="col-md-6">
        <h3 class="mb-3"># Data Grafik Penjualan Tahun <?= date('Y'); ?> </h3>
        <canvas id="myChart2"></canvas>
      </div>
    </div>
  </div>
</div>

<?php
include_once "../partials/scriptdatatables.php";
?>

<script>
  // Get cards
  var cards = $('.card-body');
  var maxHeight = 0;

  // Loop all cards and check height, if bigger than max then save it
  for (var i = 0; i < cards.length; i++) {
    if (maxHeight < $(cards[i]).outerHeight()) {
      maxHeight = $(cards[i]).outerHeight();
    }
  }
  // Set ALL card bodies to this height
  for (var i = 0; i < cards.length; i++) {
    $(cards[i]).height(maxHeight);
  }

  if ($('div#hasil_update_pw').length) {
    Swal.fire({
      title: 'Updated!',
      text: 'Password berhasil diubah',
      icon: 'success',
      confirmButtonText: 'OK'
    })
  }

  if ($('div#login_sukses').length) {
    let timerInterval
    let nama = "<?= ucfirst($_SESSION['nama']); ?>"
    Swal.fire({
      width: 'auto',
      showConfirmButton: false,
      position: 'top-end',
      html: '<h5>Selamat Datang ' + nama + ' !</h5>',
      timer: 2000,
      timerProgressBar: true,

      willClose: () => {
        clearInterval(timerInterval)
      }
    })
  };

  // $().ready(function() {
  //   let timerInterval
  //   let nama = "<?= ucfirst($_SESSION['nama']); ?>"
  //   Swal.fire({
  //     showConfirmButton: false,
  //     width: 'auto',
  //     position: 'top-end',
  //     html: '<h5>Selamat Datang ' + nama + ' !</h5>',
  //     timer: 3000,
  //     timerProgressBar: true,

  //     willClose: () => {
  //       clearInterval(timerInterval)
  //     }
  //   })
  // });

  //chart upah
  var arrayIndicator = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var arrayChartPembelian = <?= json_encode($arrayChartPembelian); ?>;
  var arrayBackground1 = [];
  var arrayBorder1 = [];

  for (let i = 0; i < arrayIndicator.length; i++) {
    r = Math.floor(Math.random() * 255);
    g = Math.floor(Math.random() * 255);
    b = Math.floor(Math.random() * 255);
    arrayBackground1.push('rgba(' + r + ', ' + g + ', ' + b + ', ' + '0.2)');
    arrayBorder1.push('rgba(' + r + ', ' + g + ', ' + b + ', ' + '1)');
  }

  Chart.Legend.prototype.afterFit = function() {
    this.height = this.height + 10;
  };

  const ctxPembelian = document.getElementById('myChart').getContext('2d');
  const myChartPembelian = new Chart(ctxPembelian, {
    type: 'bar',
    data: {
      labels: arrayIndicator,
      datasets: [{
        label: '# Jumlah Pembelian Tahun ' + new Date().getFullYear(),
        data: arrayChartPembelian,
        backgroundColor: arrayBackground1,
        borderColor: arrayBorder1,
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        labels: {
          render: 'value',
          precision: 2
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  //chart insentif
  var arrayChartPenjualan = <?= json_encode($arrayChartPenjualan); ?>;
  const ctxPenjualan = document.getElementById('myChart2').getContext('2d');
  const myChartPenjualan = new Chart(ctxPenjualan, {
    type: 'bar',
    data: {
      labels: arrayIndicator,
      datasets: [{
        label: '# Jumlah Penjualan Tahun ' + new Date().getFullYear(),
        data: arrayChartPenjualan,
        backgroundColor: arrayBackground1,
        borderColor: arrayBorder1,
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        labels: {
          render: 'value',
          precision: 2
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- /.content -->