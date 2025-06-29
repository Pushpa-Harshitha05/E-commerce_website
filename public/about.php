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
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? null;
$fetch_user = null;

if ($user_id) {
    $select_user = mysqli_query($con, "SELECT * FROM `details` WHERE id='$user_id'");
    if ($select_user && mysqli_num_rows($select_user) > 0) {
        $fetch_user = mysqli_fetch_assoc($select_user);
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Guru Mobile Accessories & Electronics</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="about_style.css">
</head>
<body>
    <header><br>
        <div class="logo">
            <p><u>Guru Mobile Accessories</u> &amp; <u> Electronics</u></p>
        </div>

        <?php if ($user_id && $fetch_user): ?>
            <div class="profile">
                <div class="cartitems">
                    <a href="shopping_cart.php" class="cartlink">
                        <img src="images/homepage_imgs/cart.png" alt="cart" id="cart">
                        <span id="cartcount">
                            <?php
                            $cartres = mysqli_query($con, "SELECT user_cart FROM `details` WHERE id = '$user_id'");
                            $rowcount = mysqli_fetch_assoc($cartres);
                            echo $rowcount ? $rowcount['user_cart'] : 0;
                            ?>
                        </span>
                    </a>
                </div>
                <div class="profile-container">
                    <img src="images/homepage_imgs/profile_img.png" alt="profile" id="profileimg">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="myprofile.php"><?= htmlspecialchars($fetch_user['firstname']) ?></a>
                        <hr>
                        <a href="myprofile.php">My Profile</a>
                        <a href="#">Orders</a>
                        <a href="#">Settings</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="userbtns">
                <a href="sign.html">Sign up</a>
                <span>or</span>
                <a href="loginform.html">Login</a>
            </div>
        <?php endif; ?>
    </header><br><br><br><br><br><br>

    <div class="start">
        <nav>
            <a href="Homepage.php">Home</a>
            <a href="appl.php">Appliances</a>
            <a href="about.php"><mark>About</mark></a>
            <a href="#phone">Contact us</a>
        </nav>
    </div>

    <div class="main-content">
        <h1 id="firstheading">Sales for Electronics Goods</h1>
        <img src="images/old_electronics.jpg" alt="Electronics goods available in our shop">
        <h2>One stop destination for all your electronic gadgets!</h2>
        <p>We offer all kinds of electronic goods like computer parts, mobile phone parts, and we also provide services
            for mobile phone and computer repairs.</p>

        <div class="address">
            <h1>Address</h1>
            <p>Appughar Road, OPP. SBI Bank, Sector-7, MVP Colony, Visakhapatnam - 530 034</p>
        </div>

        <div id="contactus">
            <div class="contact" id="phone">
                <h1>Contact us</h1>
                <p><img src="images/phon.png" alt="Phone Icon"> 9182355044</p>
            </div>
            <div class="contact">
                <h1>Mail to:</h1>
                <a href="mailto:pharshitha2005@gmail.com">
                    <img src="images/form_imgs/email_img.png" alt="email icon">pharshitha2005@gmail.com
                </a>
            </div>
        </div>
    </div>

    <footer>
        <h1>Thank you for visiting our website</h1>
        <p>Have a nice day!</p>
        <img src="images/smile.png" alt="Smiley">
    </footer>

    <script src="homepage_script.js"></script>
</body>
<?php ob_end_flush(); ?>

</html>
