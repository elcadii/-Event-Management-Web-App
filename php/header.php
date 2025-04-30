<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="headerconteiner">
        <header id="home">
            <div class="logo">
                <h1>soli <span class="logoname">events</span></h1>
            </div>
            <nav>

                <span><a class="navbare" href="http://localhost/events/php/hero.php#home">home</a></span>
                <!-- <span><a class="navbare" href="#about">about</a></span> -->
                <span><a class="navbare" href="http://localhost/events/php/hero.php#events">events</a></span>
                <span><a class="navbare" href="http://localhost/events/php/hero.php#contact">contact</a></span>
                <span><a class="navbare" href="http://localhost/events/php/ticket.php">buy tecket</a></span>



            </nav>
            <div class="login_signup">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    echo '<a href="http://localhost/events/php/profile.php"> profile <i class="fa-regular fa-circle-user" style="color: #ffffff;"></i></a>';
                } else {
                    echo '<a href="http://localhost/events/php/login.php">login <i class="fa-solid fa-right-to-bracket"></i></a>';
                    echo ' <a href="http://localhost/events/php/singup.php">sign up <i class="fa-solid fa-user-plus"></i></a>';
                }
                ?>


            </div>
            <!-- <div class="cart_shop">
                <i class="fa-solid fa-bag-shopping" style="color: rgb(211, 7, 51); font-size: 30px; cursor:pointer;"></i>
            </div> -->
            <!-- -->
        </header>
    </div>
</body>

</html>