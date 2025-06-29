<?php
ob_start();
session_start();

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
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $fullname = mysqli_real_escape_string($con, trim($_POST['fullname']));
  $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
  $address = mysqli_real_escape_string($con, trim($_POST['address']));
  $city = mysqli_real_escape_string($con, trim($_POST['city']));
  $state = mysqli_real_escape_string($con, trim($_POST['state']));

  $checkaddress = mysqli_query($con, "SELECT * FROM `addresses` WHERE address_name = '$fullname' AND phone_no = '$phone' AND street = '$address' AND city = '$city' AND state = '$state'");

  if (mysqli_num_rows($checkaddress) > 0) {
    if (array_key_exists('type', $_POST)) {
      mysqli_query($con, "DELETE FROM `addresses` WHERE address_name = '$fullname' AND phone_no = '$phone' AND street = '$address' AND city = '$city' AND state = '$state'");
    }
  } else {
    $insertaddress_sql = "INSERT INTO `addresses` (user_id,address_name,phone_no,street,city,state) VALUES ('$user_id','$fullname','$phone','$address','$city','$state')";
    $insertaddress = mysqli_query($con, $insertaddress_sql);

    if ($insertaddress) {
      redirect();
    } else {
      echo "ERROR: $insertaddress_sql <br> " . mysqli_error($con);
    }
  }
}
?>
<?php ob_end_flush(); ?>
