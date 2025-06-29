<!DOCTYPE HTML>
<html lang="en">

<?php

$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name, $port);
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {

} else {
   $select_user = mysqli_query($con, "SELECT * FROM `details` WHERE id='$user_id'");

   if (!$select_user) {
      die("query failed");
   }

   if (mysqli_num_rows($select_user) > 0) {
      $fetch_user = mysqli_fetch_assoc($select_user);
   } else {
      $fetch_user = null;
   }
}

?>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Appliances - Guru Mobile Accessories & Electronics</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="appl_style.css">
</head>

<body>
   <header><BR>
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
                     if ($rowcount) {
                        echo $rowcount['user_cart'];
                     }
                     ?>
                  </span>
               </a>
            </div>
            <div class="profile-container">
               <img src="images/homepage_imgs/profile_img.png" alt="profile" id="profileimg">
               <div class="dropdown-menu" id="dropdownMenu">
                  <a href="myprofile.php"><?php echo $fetch_user['firstname'] ?></a>
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
         <a href="Homepage.php" target="_parent">Home</a>
         <a href="appl.php" target="_self"><mark>Appliances</mark></a>
         <a href="about.php" target="_self">About</a>
         <a href="#footer" target="_self">Contact us</a>
      </nav>
   </div>

   <main>
      <h1 class="heading">Electronics Store</h1>
      <div class="contain">
         <a id="mouse" href="mouse.php" target="_self">
            <div class="sub">
               <h1>Mouse</h1>
               <img src="images/clicke.png" alt="Mouse">
               <p>Explore various mouse options</p>
            </div>
         </a>
         <a id="screen" href="screencards.php" target="_self">
            <div class="sub">
               <h1>Screen Cards</h1>
               <img src="images/card.png" alt="Screen Cards">
               <p>Discover high-performance screen cards</p>
            </div>
         </a>
         <a id="key" href="keyboards.php" target="_self">
            <div class="sub">
               <h1>Keyboard</h1>
               <img src="images/keyboard_imgs/board.png" alt="Keyboard">
               <p>Find ergonomic and gaming keyboards</p>
            </div>
         </a>
      </div>
      <div class="contain">
         <a id="speakers" href="speakers.php" target="_self">
            <div class="sub">
               <h1>Speakers</h1>
               <img src="images/speaker.png" alt="Speakers">
               <p>Shop quality speakers for all needs</p>
            </div>
         </a>
         <a id="pendrives" href="pendrives.php" target="_self">
            <div class="sub">
               <h1>Pendrives</h1>
               <img src="images/pen.png" alt="Pendrives">
               <p>Choose from a variety of pendrives</p>
            </div>
         </a>
      </div>
   </main>

   <footer id="footer">
      <div class="footer-content">
         <div class="footer-column">
            <h3>Contact Us</h3>
         </div>
         <div class="footer-column details">
            <p>Email: <a href="mailto:pharshitha2005@gmail.com">pharshitha2005@gmail.com</a></p>
            <p>Phone:
               <span class="number">+91 9182355044</span>
            </p>
            <p>Address: <span class="number">Appughar Road, OPP. SBI Bank, Sector-7, MVP Colony, Visakhapatnam - 530
                  034</span></p>
         </div>
      </div>
      <div class="footer-bottom">
         <p>&copy; 2025 Guru Mobile Accessories & Electronics. All Rights Reserved.</p>
      </div>
   </footer>

   <script src="homepage_script.js"></script>
</body>

</html>