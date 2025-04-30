<?php
// session_start();
include("connectdb.php");

$PassError = "";
$emailError = "";

if (isset($_POST['loginbtn'])) {
    $email = $_POST["loginemail"];
    $password = $_POST['loginpassword'];

    $query  = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if (password_verify($password, $row['password'])) {
            // echo "you are log in";
            //  echo "<pre>";
            // print_r($adress) ;
            // echo "</pre>";
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            // var_dump($_SESSION['address_id']);
            // die();
            header("location: http://localhost/events/php/hero.php");
        } else {
            $PassError =  "wrong password";
            $_SESSION['login'] = false;
        }
    } else {
        $emailError =  "email not found";
        $_SESSION['login'] = false;
    }
}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- From Uiverse.io by vinodjangid07 -->
    <form action="" class="form_main" method="POST">
        <div class="container">
            <p class="heading">Login</p>
            <div class="inputContainer">
                <i class="fa-solid fa-envelope" style="color:rgb(194, 7, 7);"></i>
                <input type="text" name="loginemail" class="inputField" id="email" placeholder="email">
            </div>
            <span class="error"><?php echo $emailError; ?></span>

            <div class="inputContainer">
                <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
                <input name="loginpassword" type="password" class="inputField" id="password" placeholder="Password">
            </div>
            <span class="error"><?php echo $PassError; ?></span>


            <button type="submit" name="loginbtn" id="button">Submit</button>
            <div class="forgetPass">
                <a class="forgotLink" href="#">Forgot your password?</a>
                <a href="http://localhost/events/php/singup.php">creat account</a>
            </div>

        </div>
        <!-- <img src="../img/Login-rafiki.png" alt=""> -->
    </form>
</body>

</html>