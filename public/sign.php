<?php
$insert = false;

function call()
{
    header("Location: loginform.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = "shuttle.proxy.rlwy.net";
    $username = "root";
    $password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
    $db_name = "railway";
    $port = 32509;

    // Connect to the database
    $con = mysqli_connect($server, $username, $password, $db_name, $port);

    if (!$con) {
        die("Connection failed due to " . mysqli_connect_error());
    }

    $firname = $_POST['firname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    $checkuser = "SELECT * FROM details WHERE email = '$email'";
    $checkpass = "SELECT * FROM details WHERE password = '$pass1'";
    $result = mysqli_query($con, $checkuser);
    $resultpass = mysqli_query($con, $checkpass);
    $count = mysqli_num_rows($result);
    $countpass = mysqli_num_rows($resultpass);

    if ($count > 0 && $countpass == 0) {
        echo "<script>alert('User email already exists. PLEASE LOGIN!'); window.location.href='loginform.html';</script>";
        exit();
    } elseif ($count > 0) {
        echo "<script>alert('User account already exists. PLEASE LOGIN!'); window.location.href='loginform.html';</script>";
        exit();
    } elseif ($countpass > 0) {
        echo "<script>alert('Password already taken. USE ANOTHER PASSWORD!'); window.location.href='sign.html';</script>";
        exit();
    } else {
        $sql = "INSERT INTO details (firstname, email, password, user_cart, cost) VALUES ('$firname', '$email', '$pass1', 0, 0)";
        if ($con->query($sql) === true) {
            echo "<script>alert('SUCCESSFULLY SIGNED UP!');</script>";
            call();
        } else {
            echo "ERROR: $sql <br> $con->error";
        }
    }
}
?>