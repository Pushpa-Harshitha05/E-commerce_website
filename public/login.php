<?php
ob_start();
session_start();

$insert = false;
if(isset($_POST['email']) && isset($_POST['password'])){
    $server = "shuttle.proxy.rlwy.net";
    $username = "root";
    $password = "aFIhWjQbLKBXyCVtSuVXsziRaqNrASHq";
    $db_name = "railway";
    $port = 32509;

    // Connect to the database
    $con = mysqli_connect($server, $username, $password, $db_name, $port);

    if(!$con){
        die("connection failed due to".mysqli_connect_error());
    }
    
    $email  = $_POST['email'];
    $pass1  = $_POST['password'];

    $checkuser = "SELECT * from `details` where email = '$email' AND Password = '$pass1'";
    
    $result = mysqli_query($con,$checkuser);
    $count = mysqli_num_rows($result);
    if($count == 1){
    echo "<script>alert('SUCCESSFULLY LOGGED IN !!');</script>";
    echo "<script>window.location.href='First Website.html'</script>";
    }
    else{
        echo "<script>alert('INCORRECT EMAIL OR PASSWORD');</script>";
    }
}

?>

<!DOCTYPE HTML>
<html>
<head><title>LOGIN</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        header {
            background: linear-gradient(-90deg, skyblue, white, skyblue);
            padding: 5px;
            color: darkblue;
            font-size: larger;
            width: 100%;
            height: 120px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: rgb(92, 167, 213);
            width: 100%;
            padding: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 20px;
            font-size: larger;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        nav a:hover {
            background-color: white;
            color: darkblue;
        }

        mark {
            background-color: white;
            color: black;
            padding: 20px;
        }

        body {
            background: rgb(255, 255, 255);
        }

        .container {
            margin: 10px;
            border-radius: 30px;
            width: 460px;
            border-left: 4px solid skyblue;
            border-right: 13px solid skyblue;
            height: 520px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            background: linear-gradient(-90deg, rgb(180, 222, 239), white, rgb(180, 222, 239));
            color: black;
            box-shadow: 0 0 40px rgba(0, 0, 0, .5);
        }

        form label {
            font-size: 18px;
            margin-top: 20px;
        }

        .container #emailname,#passwor {
            width: 90%;
            height: 30px;
            font-size: medium;
            border-radius: 30px;
        }

        .container a {
            cursor: pointer;
        }

        .second {
            background-color: rgb(163, 163, 170);
            border-radius: 10px;
            color: black;
            text-decoration: none;
        }

        small {
            color: rgb(70, 67, 67);
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .one {
            background-color: rgb(180, 222, 239);
            width: 50%;
            margin-left: 25%;
            border-radius: 30px;
            font-size: larger;
            box-shadow: 0 0 10px rgba(0, 0, 0, .5);
            cursor: pointer;
        }

        .one:hover {
            width: 40%;
            margin-left: 30%;
        }

        img {
            position: absolute;
            top: 58%;
            right: 40%;
        }

        form #pic {
            position: absolute;
            top: 75%;
            right: 41.5%;
        }

        .two {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        h1 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .container label {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        h4 a:hover {
            color: rgb(239, 107, 239);
        }
    </style>
    <script>
        function passing(){
    let passwording=document.getElementById("passwor").value;
    let email=document.getElementById("emailname").value;
    if(email === "" || passwording === ""){
        alert("PLEASE FILL IN THE DETAILS");
    }
}
        </script>
</head>

<body>
    <header><br>
        <h1><u>GURU MOBILE ACCESSORIES</u> &amp; <u> ELECTRONICS</u></h1>
    </header>
    <div class="start">
    <nav>
        <a href="First Website.html" target="_parent">HOME</a>
        <a href="appl.html" target="_self">APPLIANCES</a>
        <a href="about.html" target="_self">ABOUT</a>
        <a href="sign.html" target="_self"><mark>SIGN UP</mark></a>
    </nav></div><br><br><br>
    <form action="login.php" method="post">
        <div class="container">
            <br>
            <h1>
                <p align="center"><u>LOGIN</u></p>
            </h1>
            <label for="emailname">&nbsp;<br><br>E-MAIL : </label><br><br>
            <input type="email" id="emailname" name="email" placeholder="  enter your email" onmouseover="this.placeholder = ' '" ;
                onmouseout="this.placeholder = '  enter your email'" required><br><img
                src="https://img.icons8.com/?size=512&id=499&format=png" height="20px" width="20px"
                style="right: 41.5%;">
            <small id="firstone">&nbsp;We will never share your email with anyone</small><br><br><br>
            <label for="passwor">&nbsp;PASSWORD : </label><br><br>
            <input id="passwor" type="password" name="password" placeholder="  enter your password" onmouseover="this.placeholder = ' '" ;
                onmouseout="this.placeholder = '  enter your password'" required><img id="pic"
                src="https://img.icons8.com/?size=512&id=59825&format=png" height="20px" width="20px"><br><br><br>
                
            <input type="checkbox" class="two"> I Agree to Terms and Conditions<br><br><br>
            <input type="submit" class="one" value="Submit" onclick="passing()"><br><br><br>
            <h4>
                <p align="center" style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">DON'T
                    HAVE AN ACCOUNT ? <a href="sign.html">SIGN UP</a></p>
            </h4>
        </div><br><br><br>
    </form>
</body>

</html>