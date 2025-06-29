<!DOCTYPE html>

<?php

$server = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
$db_name = "railway";
$port = 32509;

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name, $port);
session_start();

$change = true;

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

$get_cartname = [];

?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="shoppingcart_styles.css">
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
      <a href="appl.php" target="_self">Appliances</a>
      <a href="about.php" target="_self">About</a>
      <a href="#footer" target="_self">Contact us</a>
    </nav>
  </div>

  <main class="content">
    <div class="cart-container">
      <h2 class="cart-title">Your Shopping Cart</h2>
      <div class="user-cart">
        <?php
        $get_products = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

        if (mysqli_num_rows($get_products) > 0) {
          $change = false;
          while ($product = mysqli_fetch_assoc($get_products)) {
            $get_cartname[] = $product['name'];
            ?>
            <div class="product-item">
              <div class="product-image">
                <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>">
              </div>
              <div class="product-details">
                <p class="product-name"><?php echo $product['name']; ?></p>
                <p class="product-desc"><?php echo $product['description'] ?></p>
                <p class="product-price"><?php echo $product['price'] ?></p>
                <div class="product-quantity">
                  <p>Quantity <span>1</span></p>
                </div>
              </div>
            </div>
            <?php
          }
        } else {
          echo "<p class='no-products'>No products found.</p>";
          $change = true;
        }
        ?>
      </div>
    </div>

    <div class="total-cost">
      <div class="buyoption">
        <p>Total Items:
          <span>
            <?php
            $getcount = mysqli_query($con, "SELECT COUNT(*) AS total FROM `cart` WHERE user_id = '$user_id'");
            $row1 = mysqli_fetch_assoc($getcount);
            echo $row1['total'];
            ?>
          </span>
        </p>
        <p>Subtotal: &#8377 <span id="getcost">
            <?php
            $usercost = mysqli_query($con, "SELECT cost FROM `details` WHERE id = '$user_id'");
            $rowcost = mysqli_fetch_assoc($usercost);
            if ($rowcost) {
              echo $rowcost['cost'];
            }
            ?>
          </span></p>
        <div class="buydiv">
          <button type="button" id="buybtn">Proceed to Buy</button>
        </div>
      </div>

      <div class="otheritems">
        <p align="start">Pair with your cart</p>
        <?php

        $placeholders = "'" . implode("','", $get_cartname) . "'";
        $display_products = mysqli_query($con, "SELECT * FROM `products` WHERE name NOT IN ($placeholders) LIMIT 3");

        while ($display = mysqli_fetch_assoc($display_products)) {
          ?>
          <div class="items">
            <span id="product-type"><?php echo $display['product_type'] ?></span>
            <div class="product-image">
              <img src="<?php echo $display['product_image'] ?>" alt="<?php echo $display['name']; ?>">
            </div>
            <div class="product-details">
              <p class="product-name"><?php echo $display['name']; ?></p>
              <p class="product-desc"><?php echo $display['description'] ?></p>
              <p class="product-price"><?php echo $display['price'] ?></p>
            </div>
          </div>
          <?php
        }

        ?>
      </div>
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
  <script>
    function changebutton() {
      let changebtn = document.getElementById('buybtn');
      if (changebtn) {
        changebtn.innerHTML = 'Add items to cart';
        changebtn.addEventListener('click', () => {
          window.location.href = 'appl.php';
        });
      }
    }

    if (<?php echo json_encode($change) ?>) {
      window.onload = changebutton;
    }

    document.getElementById('buybtn').addEventListener('click', () => {
      window.location.href = 'orders.php';
    })

  </script>
</body>

</html>