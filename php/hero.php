<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
  include("connectdb.php");
  include("header.php");




  $fetchevent = "SELECT evente.*, Category.category_name 
                FROM evente 
                INNER JOIN Category ON evente.category_id = Category.category_id 
                LIMIT 3";
  $eventes = $pdo->query($fetchevent)->fetchAll(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" href="../style/hero.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div id="home" class="slideshow-container">

    <div class="mySlides fade">
      <div class="numbertext">1 / 5</div>
      <img src="../img/heroeventimg.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 5</div>
      <img src="../img/hero4.jpg" style="width:100%">
    </div>
    <div class="mySlides fade">
      <div class="numbertext">3 / 5</div>
      <img src="../img/here we show.webp" style="width:100%">
    </div>

    <div class="mySlides fade">
      <div class="numbertext">4 / 5</div>
      <img src="../img/heroimg3.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <div class="numbertext">5 / 5</div>
      <img src="../img/hero5.jpg" style="width:100%">
    </div>

    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

  </div>
  <br>

  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>


  <section id="events" class="tickets">
    <div class="best_event">

      <?php
      // fetch event in div 
      foreach ($eventes as $event) {
        echo '<div class="tiket">
                    <img src="../' . $event['event_image'] . '" alt="' . $event['event_name'] . '">
                    <p class="eventName">' . $event['event_name'] . '</p>
                    <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i>' . $event['category_name'] . '</p>
                    <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>' . $event['event_description'] . '</p>
                    <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>' . $event['start_date'] . '</p>
                    <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> starting from' . $event['spicail_tarif'] . '</p>
                    <a href="ticketcart.php?event_id=' . $event['event_id'] . '"><button>See More</button></a>

                    
                    
                </div>';
      };
      ?>
      <!-- <div class="tiket">
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
      <div class="tiket">
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
      <div class="tiket">
        <img src="../img/here we show.webp" alt="">
        <p class="eventName">here we show</p>
        <p class="category"><i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51);padding:10px;"></i> sinima</p>
        <p class="eventDesc"> <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51);padding:10px;"></i>rhkref uhfkrjef kjhkjf hjkerhf</p>
        <p class="eventdate"><i class="fa-regular fa-clock" style="color:  rgb(211, 7, 51); padding:10px;"></i>20_02_2025</p>
        <p class="eventAdress"><i class="fa-solid fa-location-dot" style="color:rgb(211, 7, 51);padding:10px;"></i> casablanca</p>
        <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> normal tarif 100 dh</p>
        <p class="tickettPrice"><i class="fa-solid fa-money-check-dollar" style="color:rgb(211, 7, 51);padding:10px;"></i> spiceal tarif 50 dh</p>
        <button>buy ticket</button>
      </div> -->



    </div>
    <div class="moreTecket">
      <a href="http://localhost/events/php/ticket.php">view more events <i class="fa-solid fa-arrow-right" style="color: rgb(211, 7, 51);"></i></a>
    </div>
  </section>
  <section id="contact" class="contact">
    <!-- From Uiverse  -->
    <form class="form">

      <div class="flex">
        <label>
          <input required="" placeholder="" type="text" class="input">
          <span>first name</span>
        </label>

        <label>
          <input required="" placeholder="" type="text" class="input">
          <span>last name</span>
        </label>
      </div>

      <label>
        <input required="" placeholder="" type="email" class="input">
        <span>email</span>
      </label>

      <label>
        <input required="" type="tel" placeholder="" class="input">
        <span>contact number</span>
      </label>
      <label>
        <textarea required="" rows="3" placeholder="" class="input01"></textarea>
        <span>message</span>
      </label>

      <button class="fancy" href="#">
        <span class="top-key"></span>
        <span class="text">contact us</span>
        <span class="bottom-key-1"></span>
        <span class="bottom-key-2"></span>
      </button>
    </form>
    <div class="imgcontact">
      <img src="../img/Feedback-pana.png" alt="">
    </div>
  </section>













  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
    setInterval(() => {
      plusSlides(1);
    }, 3000);
  </script>

</body>

</html>