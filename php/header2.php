<?php
include("connectdb.php");
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'All';
$fetchcaty = "SELECT DISTINCT category_name FROM category";
$cat = $pdo->query($fetchcaty);



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
</head>

<body>
    <div class="header2" id="home">
        <nav>
            <span><a class="navbare" href="?category=All">All</a></span>

            <?php
            foreach ($cat as $catg) {
                echo '<span><a class="navbare" href="?category=' . urlencode($catg['category_name']) . '">' . $catg['category_name'] . '</a></span>';
            };
            ?>
            <!-- <span><a class="navbare" href="#home">music</a></span>
                <span><a class="navbare" href="#about">sinima</a></span>
                <span><a class="navbare" href="#services">Theatre</a></span> -->

        </nav>
        <form action="" method="GET" class="search">
            <input type="search" name="search" placeholder="search for product name" />
            <button type="submit" name="searchBtn">search</button>
        </form>
    </div>
</body>

</html>