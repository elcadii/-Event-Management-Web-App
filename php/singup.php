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
    <form action="" class="form_main">
        <div class="container">
            <p class="heading">sing up</p>

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
                <input type="text" class="inputField" id="email" placeholder="email">
            </div>

            <div class="inputContainer">
                <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
                <input type="password" class="inputField" id="password" placeholder="Password">
            </div>

            <div class="inputContainer">
                <i class="fa-solid fa-lock" style="color:rgb(201, 5, 5);"></i>
                <input type="password" class="inputField" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            </div>





            <button id="button">Submit</button>
            <div class="forgetPass">
                <p>i have an account</p>
                <a href="">sing up</a>
            </div>

        </div>
        <!-- <img src="../img/Login-rafiki.png" alt=""> -->
    </form>
</body>

</html>