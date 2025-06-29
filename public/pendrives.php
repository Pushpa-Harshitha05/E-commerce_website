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

$usercart = 0;

if (isset($_POST['addtocartbtn'])) {

  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

  if ($user_id) {

    if (!$fetch_user) {
      header("Location:sign.html");
    }

    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' and user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {

    } else {
      if ($user_id) {

        $product_desc_esc = mysqli_real_escape_string($con, $product_desc);

        mysqli_query($con, "INSERT INTO `cart`(user_id,name,price,image,description) VALUES ('$user_id','$product_name','$product_price','$product_image','$product_desc_esc')") or die('query failed');

        $res = mysqli_query($con, "SELECT user_cart,cost FROM `details` WHERE id = '$user_id'");
        if ($row = mysqli_fetch_assoc($res)) {
          $usercart = $row['user_cart'];
          $cost = $row['cost'];
          $number = preg_replace('/[^0-9.]/', '', $product_price);
          $number = (float) $number;

          $usercart += 1;
          $cost += $number;

          mysqli_query($con, "UPDATE `details` SET user_cart = '$usercart', cost = '$cost' WHERE id = '$user_id'");

        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

      } else {
        header("Location:loginform.html");
      }
    }
  } else {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location:loginform.html");
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PENDRIVE ELECTRONIC APPLIANCES</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="products_style.css">
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
  <section>
    <h1>Pendrives</h1>
  </section>

  <?php

  $pcount = 1;
  $select_product = mysqli_query($con, 'SELECT * FROM `products` WHERE product_type = "pendrive"') or die('query failed');

  if (mysqli_num_rows($select_product) > 0) {
    while ($fetch_product = mysqli_fetch_assoc($select_product)) {

      if (($pcount == 1) || ($pcount == 4)) {
        $classcontainer = 'product-container';
        echo "<main class='$classcontainer'>";
      } else if ($pcount == 7) {
        $classcontainer = 'product-container';
        $idcontainer = 'hide';
        echo '<button type="button" id="loadbtn">Load More</button>';
        echo "<main class='$classcontainer' id='$idcontainer'>";
      }
      ?>

      <form action="" method="post" class="product">
        <img src="<?php echo $fetch_product['product_image'] ?>" alt="<?php echo $fetch_product['name']; ?>">
        <h3><?php echo $fetch_product['name']; ?></h3>
        <p><?php echo $fetch_product['description']; ?></p>
        <p>
          <b><?php echo $fetch_product['price']; ?></b> <s><?php echo $fetch_product['strike']; ?></s>
          <?php echo $fetch_product['para']; ?>
        </p>
        <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_image'] ?>">
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
        <input type="hidden" name="product_desc" value="<?php echo $fetch_product['description']; ?>">
        <div class="checkoutbtns">
          <button class="btnsubmit buynow" name="buynowbtn">Buy Now</button>
          <button class="btnsubmit addtocart" name="addtocartbtn">Add To Cart</button>
        </div>
      </form>



      <?php
      if (($pcount % 3) == 0) {
        echo "</main>";
      }
      $pcount++;
    }
    if ((($pcount - 1) % 3) != 0) {
      echo "</main>";
    }
  } else {
    echo '<p align="center" style="font-size:1.2rem;margin:65px">No Products Found</p>';
  }
  ?>

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
  <script src="loadmore_script.js"></script>
</body>

</html>