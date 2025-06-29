<?php

$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name, $port);
session_start();

if (!$con) {
  die("connection failed");
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
  $query = mysqli_query($con, "SELECT user_cart FROM `details` WHERE id = '$user_id'");
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    return $row['user_cart'];
  } else {
    return 0;
  }
}

?>