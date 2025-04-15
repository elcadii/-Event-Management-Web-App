<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    include("connectdb.php");
    // die();

    include("header.php");
    include("header2.php");
    echo "start code";
    // die();

    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'All';
    echo "we are at the start";

    if ($selectedCategory !== 'All') {
        $fetchevent = "SELECT evente.*, Category.category_name 
                                    FROM evente 
                                    INNER JOIN Category ON evente.category_id = Category.category_id
                                    WHERE Category.category_name = :category";
        $stmt = $pdo->prepare($fetchevent);
        $stmt->execute(['category' => $selectedCategory]);
        $eventes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($eventes);
        // echo "</pre>";
    } else {
        $fetchevent = "SELECT evente.*, Category.category_name 
                                    FROM evente 
                                    INNER JOIN Category ON evente.category_id = Category.category_id";
        $eventes = $pdo->query($fetchevent)->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($eventes);
        // echo "</pre>";
    }



    // search btn 
    if (isset($_GET["searchBtn"])) {
        $search = $_GET["search"];
        $searchQuery = "SELECT evente.* , Category.category_name 
                                    FROM evente 
                                    INNER JOIN Category ON evente.category_id = Category.category_id
                                    WHERE event_name LIKE '%$search%'";

        $searchResult = $pdo->query($searchQuery)->fetchAll();
        if (empty($searchResult)) {
            echo "No results found!";
        } else {
            $eventes = $searchResult;
        }
    }
} else {
    header("location: http://localhost/events/php/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/ticket.css">
</head>

<body>
    <div class="contener">
        <div class="ticketmenu">
            <div class="products">
                <?php
                foreach ($eventes as $event) {
                    echo '<div class="product">
                        <div class="imgdiv">
                            <img src="../' . $event['event_image'] . '" alt="' . $event['event_name'] . '">
                        </div>
                        <div class="eventDesc">
                            <h2 class="eventName">' . $event['event_name'] . '</h2>
                            <p class="category">
                                <i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i>
                                ' . $event['category_name'] . '
                            </p>
                            <p class="eventDesc">
                                <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>
                                ' . $event['event_description'] . '
                            </p>
                            <p class="eventdate">
                                <i class="fa-regular fa-clock" style="color: rgb(211, 7, 51); padding:10px;"></i>
                                ' . $event['start_date'] . '
                            </p>
                            <p class="tickettPrice">
                                <i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i>
                                Starting from ' . $event['spicail_tarif'] . ' DH
                            </p>
                            <a href="ticketcart.php?event_id=' . $event['event_id'] . '">
                                <button>See More</button>
                            </a>
                        </div>
                    </div>';
                }
                ?>
                <!-- <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button>buy ticket</button>
                </div>
                <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button>buy ticket</button>
                </div>
                <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button>buy ticket</button>
                </div>
                <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button>buy ticket</button>
                </div>
                <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button>buy ticket</button>
                </div>
                <div class="product">
                    <img src="../img/here we show.webp" alt="">
                    <p class="eventName">here we show</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                    <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
                    <button><a href="http://localhost/events/php/ticketcart.php">buy ticket</a></button>
                </div> -->



            </div>
        </div>
    </div>
</body>

</html>