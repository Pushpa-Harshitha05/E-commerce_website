<?php
$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Create connection
$con = mysqli_connect($server, $username, $password, $db_name, $port);

// Check connection
if (!$con) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Successfully connected to Railway DB!yayyyyyy";
}
?>
