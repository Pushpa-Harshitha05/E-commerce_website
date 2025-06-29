<?php
ob_start();
session_start();

$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name, $port);

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id != null) {

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['edit_username'])) {

      $new_username = mysqli_real_escape_string($con, $_POST['new_username']);
      mysqli_query($con, "UPDATE `details` SET firstname='$new_username' WHERE id='$user_id'");

    }

    if (isset($_POST['edit_email'])) {

      $new_email = mysqli_real_escape_string($con, $_POST['new_email']);
      $result = mysqli_query($con, "SELECT * FROM `details` WHERE email='$new_email'");
      if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('email already exists')</script>";
      } else {
        mysqli_query($con, "UPDATE `details` SET email='$new_email' WHERE id='$user_id'");
      }

    }

    if (isset($_POST['edit_password'])) {

      $new_password = $_POST['new_password'];
      mysqli_query($con, "UPDATE `details` SET password='$new_password' WHERE id='$user_id'");

    }

    echo "<script>alert('successfully updated your details')</script>";
    echo "<script>window.location.href = 'editlogin.php'</script>";
    exit();

  }

}

?>