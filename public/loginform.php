<?
ob_start();
session_start();

$insert = false;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $server = "shuttle.proxy.rlwy.net";
    $username = "root";
    $password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
    $db_name = "railway";
    $port = 32509;

    // Connect to the database
    $con = mysqli_connect($server, $username, $password, $db_name, $port);

    // Check connection
    if (!$con) {
        die("Connection failed due to: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass1 = mysqli_real_escape_string($con, $_POST['password']);

    // SQL query to check user
    $checkuser = "SELECT * FROM `details` WHERE email = '$email' AND password = '$pass1'";
    $checkemail = "SELECT * FROM `details` WHERE email = '$email'";
    $checkpass = "SELECT * FROM `details` WHERE password = '$pass1'";

    $result = mysqli_query($con, $checkuser);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
    
        if (isset($_SESSION['redirect_after_login'])) {
            $redirect_url = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect_url");
        } else {
            header("Location: Homepage.php"); // default fallback
        }
        exit();

    } elseif (((mysqli_num_rows(mysqli_query($con, $checkemail))) == 0) and ((mysqli_num_rows(mysqli_query($con, $checkpass))) == 0)) {
        echo "<script>alert('EMAIL DOES NOT EXIST!! Please Create Account');</script>";
        echo "<script>window.location.href='sign.html';</script>";
    } else {
        echo "<script>alert('INCORRECT EMAIL OR PASSWORD');</script>";
        echo "<script>window.location.href='loginform.html';</script>";
    }

    // Close connection
    mysqli_close($con);
}
?>