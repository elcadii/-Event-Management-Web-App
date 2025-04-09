<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/ticketcart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="ticketCart">
        <div class="container">
            <div class="imgdiv">
                <img src="../img/here we show.webp" alt="">
            </div>
            <div class="eventDesc">
                <h2 class="eventName">here we show</h2>
                <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
                <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
                <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
                <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
                <div class="normalPrice">

                    <p> <i class="fa-solid fa-money-bill-wave" style="color:rgb(211, 7, 51);"></i> normal price</p>
                    <div class="pricediv">
                        <i class="fa-solid fa-minus" style="color: rgb(211, 7, 51);"></i>
                        <p>100</p>
                        <i class="fa-solid fa-plus" style="color: rgb(211, 7, 51);"></i>
                        
                    </div>

                </div>
                <div class="spicealPrice">
                    <p> <i class="fa-solid fa-money-bill-wave" style="color:rgb(211, 7, 51);"></i> spiceal price</p>
                    <div class="pricediv">
                        <i class="fa-solid fa-minus" style="color: rgb(211, 7, 51);"></i>
                        <p>50</p>
                        <i class="fa-solid fa-plus" style="color: rgb(211, 7, 51);"></i>

                    </div>
                </div>
                <button class="pdfBTN">get ticket</button>
            </div>
        </div>

    </section>
</body>

</html>