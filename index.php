<?php
session_start();
if (!isset($_SESSION['level'])) {
  echo '<meta http-equiv="refresh" content="0;url=/login.php">';
  die();
} else {
  if ($_SESSION['level'] == "Owner") {
    echo '<meta http-equiv="refresh" content="0;url=owner/"/>';
    die();
  } else if ($_SESSION['level'] == "Admin") {
    echo '<meta http-equiv="refresh" content="0;url=admnin/"/>';
    die();
  } else if ($_SESSION['level'] == "Kasir") {
    echo '<meta http-equiv="refresh" content="0;url=kasir/"/>';
    die();
  }
}
