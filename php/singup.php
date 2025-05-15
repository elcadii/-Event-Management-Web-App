<?php
// session_start();
include("connectdb.php");

$errors = [];
$first_name = $last_name = $email = "";

if (isset($_POST['singup'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // First name
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required.";
    }

    // Last name
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required.";
    }

    // Email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = "Email already exists.";
        }
    }

    // Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    // Confirm password
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // If no errors, insert into DB
    if (empty($errors)) {
        $sql = "INSERT INTO users (first_name, last_name, email, password) 
                VALUES (:first_name, :last_name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // Get user and set session
        $stmt1 = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt1->execute([$email]);
        $user = $stmt1->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        header("Location: http://localhost/events/php/login.php");
        exit();
    }
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
  <form action="" method="POST" class="form_main">
    <div class="container">
      <p class="heading">Create an account</p>

      <div class="inputContainer">
        <i class="fa-solid fa-user" style="color:rgb(201, 5, 5);"></i>
        <input type="text" class="inputField" id="first_name" name="first_name" placeholder="Enter your first name" value="<?= htmlspecialchars($first_name) ?>">
        <?php if (!empty($errors['first_name'])): ?>
          <p style="color:red; font-size:0.8em;"><?= $errors['first_name'] ?></p>
        <?php endif; ?>
      </div>

      <div class="inputContainer">
        <i class="fa-solid fa-user" style="color:rgb(201, 5, 5);"></i>
        <input type="text" class="inputField" id="last_name" name="last_name" placeholder="Enter your last name" value="<?= htmlspecialchars($last_name) ?>">
        <?php if (!empty($errors['last_name'])): ?>
          <p style="color:red; font-size:0.8em;"><?= $errors['last_name'] ?></p>
        <?php endif; ?>
      </div>

      <div class="inputContainer">
        <i class="fa-solid fa-envelope" style="color:rgb(194, 7, 7);"></i>
        <input type="text" class="inputField" name="email" id="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
        <?php if (!empty($errors['email'])): ?>
          <p style="color:red; font-size:0.8em;"><?= $errors['email'] ?></p>
        <?php endif; ?>
      </div>

      <div class="inputContainer">
        <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
        <input type="password" class="inputField" name="password" id="password" placeholder="Password">
        <?php if (!empty($errors['password'])): ?>
          <p style="color:red; font-size:0.8em;"><?= $errors['password'] ?></p>
        <?php endif; ?>
      </div>

      <div class="inputContainer">
        <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
        <input type="password" class="inputField" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
        <?php if (!empty($errors['confirm_password'])): ?>
          <p style="color:red; font-size:0.8em;"><?= $errors['confirm_password'] ?></p>
        <?php endif; ?>
      </div>

      <button type="submit" name="singup" id="button">Submit</button>

      <div class="forgetPass">
        <p>I have an account</p>
        <a href="http://localhost/events/php/login.php">Log in</a>
      </div>
    </div>
  </form>
</body>

</html>