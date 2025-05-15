<?php
// session_start();
include("connectdb.php");

$errors = [];
$email = "";


if (isset($_POST['loginbtn'])) {
    $email = trim($_POST["loginemail"]);
    $password = $_POST['loginpassword'];

    
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (empty($errors)) {
        $query  = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];

                header("Location: http://localhost/events/php/hero.php");
                exit();
            } else {
                $errors['password'] = "Wrong password.";
            }
        } else {
            $errors['email'] = "Email not found.";
        }
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
  <form action="" class="form_main" method="POST">
    <div class="container">
      <p class="heading">Login</p>

      <div class="inputContainer">
        <i class="fa-solid fa-envelope" style="color:rgb(194, 7, 7);"></i>
        <input type="text" name="loginemail" class="inputField" id="email" placeholder="Email"
          value="<?= htmlspecialchars($email) ?>">
      </div>
      <?php if (!empty($errors['email'])): ?>
        <span class="error" style="color:red; font-size: 0.8em;"><?= $errors['email'] ?></span>
      <?php endif; ?>

      <div class="inputContainer">
        <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
        <input name="loginpassword" type="password" class="inputField" id="password" placeholder="Password">
      </div>
      <?php if (!empty($errors['password'])): ?>
        <span class="error" style="color:red; font-size: 0.8em;"><?= $errors['password'] ?></span>
      <?php endif; ?>

      <button type="submit" name="loginbtn" id="button">Submit</button>

      <div class="forgetPass">
        <a class="forgotLink" href="#">Forgot your password?</a>
        <a href="http://localhost/events/php/singup.php">Create account</a>
      </div>
    </div>
  </form>
</body>

</html>