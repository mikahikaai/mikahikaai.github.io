<?php
include "database/database.php";
$database = new Database;
$db = $database->getConnection();
session_start();
// var_dump($_SERVER);
// die();

// var_dump($_SERVER["HTTP_HOST"]);
// die();

if (isset($_SESSION['suksesreset'])) {
  $suksesreset = true;
} else {
  $suksesreset = false;
}

if (isset($_SESSION['errorakses'])) {
  $errorakses = true;
} else {
  $errorakses = false;
}

$errorlogin = false;

if (isset($_SESSION['level'])) {
  if ($_SESSION['level'] == "Owner") {
    echo '<meta http-equiv="refresh" content="0;url=/owner/"/>';
  } else if ($_SESSION['level'] == "Admin") {
    echo '<meta http-equiv="refresh" content="0;url=/admin/"/>';
  } else if ($_SESSION['level'] == "Kasir") {
    echo '<meta http-equiv="refresh" content="0;url=/kasir/"/>';
  }
  die();
}

if (isset($_POST['login'])) {
  $loginsql = "SELECT * FROM data_pengguna WHERE username=? and password=?";
  $stmt = $db->prepare($loginsql);
  $stmt->bindParam(1, $_POST['username']);
  $stmt->bindParam(2, $_POST['password']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['login_sukses'] = true;

    // var_dump($_SESSION['level']);
    // die();

    if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "Owner") {
        echo '<meta http-equiv="refresh" content="0;url=/owner/"/>';
      } else if ($_SESSION['level'] == "Admin") {
        echo '<meta http-equiv="refresh" content="0;url=/admin/"/>';
      } else if ($_SESSION['level'] == "Kasir") {
        echo '<meta http-equiv="refresh" content="0;url=/kasir/"/>';
      }
      die();
    }
  } else {
    $errorlogin = true;
  }
}

// var_dump($_SESSION['level']);
// die();


// var_dump($errorlogin);
// die();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Login | Apotek Fatih</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="../images/logooo cropped resized compressed.png" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="login/css/style.css">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

</head>

<body class="img js-fullheight" style="background-image: url(login/images/bg.jpg);">
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h2 class="heading-section">Apotek Fatih</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <div style='display: <?= $errorlogin == true ? "block;" : "none;"; ?>'>
              <div class="alert alert-danger alert-dismissable">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>
                <h5><i class="fas fa-times"></i> Gagal</h5>
                Username atau password salah
              </div>
            </div>
            <div style='display: <?= $suksesreset == true ? "block;" : "none;"; ?>'>
              <?php
              unset($_SESSION['suksesreset']);
              ?>
              <div class="alert alert-success alert-dismissable">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>
                <h5><i class="fas fa-check"></i> Sukses</h5>
                Password berhasil direset
              </div>
            </div>
            <div style='display: <?= $errorakses == true ? "block;" : "none;"; ?>'>
              <?php
              unset($_SESSION['errorakses']);
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>
                <h5><i class="fas fa-check"></i> Gagal</h5>
                Halaman reset password sudah tidak valid
              </div>
            </div>
            <form action="" method="POST" class="signin-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $_POST['username'] ?? '' ?>" required>
              </div>
              <div class="form-group">
                <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3" name="login">Masuk</button>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50">
                </div>
                <div class="w-50 text-md-right">
                  <a href="/lupa_password.php" style="color: #fff">Lupa Password</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="login/js/jquery.min.js"></script>
  <script src="login/js/popper.js"></script>
  <script src="login/js/bootstrap.min.js"></script>
  <script src="login/js/main.js"></script>

</body>