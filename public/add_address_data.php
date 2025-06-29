<?php

function redirect()
{
  header("Location:address.php");
  exit();
}

$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name, $port);
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (!$con) {
    die("connection failed due to" . mysqli_connect_error());
  }

  $fullname = trim($_POST['fullname']);
  $phone = trim($_POST['phone']);
  $address = trim($_POST['address']);
  $city = trim($_POST['city']);
  $state = trim($_POST['state']);

  $checkaddress = mysqli_query($con, "SELECT * FROM `addresses` WHERE address_name = '$fullname' AND phone_no = '$phone' AND street = '$address' AND city = '$city' AND state = '$state'");

  if (mysqli_num_rows($checkaddress) > 0) {

    if (array_key_exists('type', $_POST)) {
      $deleteaddr = mysqli_query($con, "DELETE FROM `addresses` WHERE address_name = '$fullname' AND phone_no = '$phone' AND street = '$address' AND city = '$city' AND state = '$state'");
    }

  } else {
    $insertaddress = mysqli_query($con, "INSERT INTO `addresses` (user_id,address_name,phone_no,street,city,state) VALUES ('$user_id','$fullname','$phone','$address','$city','$state')");

    if ($con->query($insertaddress) == true) {
      redirect();
    } else {
      echo "ERROR: $sql <br> $con->error";
    }
  }
}

?>