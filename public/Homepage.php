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
   <title>Electronic shopping site</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="homepage_style.css">
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
      <?php elseif ($user_id):
         $user_id = null;
         ?>
         <div class="userbtns">
            <a href="sign.html">Sign up</a>
            <span>or</span>
            <a href="loginform.html">Login</a>
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
         <a href="#" target="_parent"><mark>Home</mark></a>
         <a href="appl.php" target="_self">Appliances</a>
         <a href="about.php" target="_self">About</a>
         <a href="#footer" target="_self">Contact us</a>
      </nav>
   </div>
   <div class="total">
      <h3 align="center">Welcome to Guru Mobile Accessories &amp; Electronics</h3>
      <p align="center"><select id="mySelect" onchange="changeoption()">
            <option value="" style="display:none">select a product</option>
            <option value="mouse">Mouse</option>
            <option value="keyboards">Keyboards</option>
            <option value="screencards">Screencards</option>
            <option value="speakers">Speakers</option>
            <option value="pendrives">Pendrives</option>
         </select>
         <input type="image" src="images/homepage_imgs/search_img.png" id="btn" onclick="search()">
      </p>
      <br><br>

      <marquee behaviour="alternate" scrollamount="20" onmouseover="this.stop()" onmouseout="this.start()">
         <div class="row">
            <img id="pict" src="images/homepage_imgs/scroll_img1.jpg">
         </div>
         <div class="row">
            <img id="pict" src="images/homepage_imgs/scroll_img2.jpeg">
         </div>
         <div class="row">
            <img id="pict" src="images/homepage_imgs/scroll_img3.jpg">
         </div>
      </marquee>
      <br><br>
      <div class="column">
         <img id="pic" src="images/homepage_imgs/sale1.jpg">
         <p>LOWEST&nbsp;AND&nbsp;AFFORDABLE&nbsp;PRICES</p><br><br><br>
      </div>
      <div class="column">
         <img id="pic" src="images/homepage_imgs/sale2.jpg">
         <p>BEST&nbsp;OF&nbsp;ELECTRONIC&nbsp;GOODS</p><br><br><br>
      </div>
      <div class="links">
         <div>
            <u>
               <h2 class="heading">ELECTRONIC&nbsp;APPLIANCES&nbsp;FROM&nbsp;VARIOUS&nbsp;BRANDS</h2>
            </u>
         </div>
         <div class="second">
            <a href="mouse.php"><img id="pic" src="images/mouse_imgs/mouse1.jpeg"></a>
         </div>
         <div class="second">
            <a href="pendrives.php"><img id="pic" src="images/pendrive_imgs/pendrive5.jpg"></a>
         </div>
         <div class="second">
            <a href="keyboards.php"><img id="pic" src="images/homepage_imgs/keyboard_img.png"
                  style="background-color: white;"></a>
         </div>
         <div class="second">
            <a href="screencards.php"><img id="pic" src="images/screencard_imgs/screen1.jpeg"></a>
         </div>
      </div>
      <div class="column last">
         <div class="columnpic">
            <img src="images/homepage_imgs/phones_img.jpg">
         </div>
         <div>
            <p>
               ALL KIND OF MOBILE
               ACCESSORIES AND ELECTRONIC APPLIANCES AVAILABLE</p>
         </div>
      </div>
      <br>
   </div>
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