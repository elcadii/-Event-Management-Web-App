<?php
// session_start();
// session_start();
include("connectdb.php");
$exist = "";
$mutchPassword = "";

if (isset($_POST['singup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password == $confirm_password && !empty($password) && !empty($email) && !empty($first_name) && !empty($last_name) && FILter_var($email, FILTER_VALIDATE_EMAIL ) && strlen($password >= 6)){
        $stmt=$pdo-> prepare("SELECT email FROM users WHERE email =? ");
        $stmt->execute([$email]) ;
        $st = $stmt->fetch(PDO::FETCH_ASSOC);
       if($st){
         $exist =  "Email already exist";
       }else{
        $sql = "INSERT INTO users(first_name, last_name, email, password ) VALUES(:first_name, :last_name, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email,'password' => password_hash($password, PASSWORD_DEFAULT)]);
                // echo "Registration successful";

                $stmt1 = $pdo->prepare("SELECT * FROM users WHERE email =? ");
                $stmt1->execute([$email]) ;
                $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                // $_SESSION['name'] = 'yahya';
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];

                

               // echo "Registration successful";


                header("location: http://localhost/events/php/login.php");

            
                
       }
    }else{
        $mutchPassword = "Password not match or not strong ";
    };
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/singup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- From Uiverse.io by vinodjangid07 -->
    <form action="" method="POST" class="form_main">
        <div class="container">
            <p class="heading">creat an account</p>

            <div class="inputContainer">
                <i class="fa-solid fa-user" style="color:rgb(201, 5, 5);"></i>
                <input type="text" class="inputField" id="first_name" name="first_name" required placeholder="Enter your first name">
            </div>

            <div class="inputContainer">
                <i class="fa-solid fa-user" style="color:rgb(201, 5, 5);"></i>
                <input type="text" class="inputField" id="last_name" name="last_name" required placeholder="Enter your last name">
            </div>


            <div class="inputContainer">
                <i class="fa-solid fa-envelope" style="color:rgb(194, 7, 7);"></i>
                <input type="text" class="inputField" name="email" id="email" placeholder="email">
            </div>

            <div class="inputContainer">
                <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
                <input type="password" class="inputField" name="password" id="password" placeholder="Password">
            </div>

            <div class="inputContainer">
                <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
                <input type="password" class="inputField" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            </div>





            <button type="submit" name="singup" id="button">Submit</button>
            <div class="forgetPass">
                <p>i have an account</p>
                <a href="http://localhost/events/php/login.php">long in</a>
            </div>

        </div>
        <!-- <img src="../img/Login-rafiki.png" alt=""> -->
    </form>
</body>

</html>