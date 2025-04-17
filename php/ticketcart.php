<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    include("header.php");
    include("connectdb.php");

    // Check if event_id is provided
    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];

        // Fetch event details along with the salle name and category name
        $fetchEventDetails = "SELECT evente.*, 
                                 Category.category_name, 
                                 Salle.salle_name 
                          FROM evente 
                          INNER JOIN Category ON evente.category_id = Category.category_id 
                          INNER JOIN Salle ON evente.salle_id = Salle.salle_id 
                          WHERE event_id = :event_id";
        $stmt = $pdo->prepare($fetchEventDetails);
        $stmt->execute(['event_id' => $event_id]);
        $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Handle ticket reservation when button is clicked
    if (isset($_POST['ticketBtn'])) {
        // Get user session and input values
        $user_id = $_SESSION['user_id'];
        $normal_tarif_quantity = $_POST['normal_tarif_quantity'] ?? 0;
        $special_tarif_quantity = $_POST['special_tarif_quantity'] ?? 0;
        $date_now = date('Y-m-d H:i:s');
        // Insert reservation into the database
        $insertReservation = "INSERT INTO resrvtion (date_now, event_id, user_id, normal_tarif, spicail_tarif) 
                              VALUES (:date_now, :event_id, :user_id, :normal_tarif, :spicail_tarif)";
        $stmt = $pdo->prepare($insertReservation);
        $stmt->execute([
            'date_now' => $date_now,
            'event_id' => $event_id,
            'user_id' => $user_id,
            'normal_tarif' => $normal_tarif_quantity,
            'spicail_tarif' => $special_tarif_quantity
        ]);
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
    <title><?php echo htmlspecialchars($eventDetails['event_name']); ?> - Ticket</title>
    <link rel="stylesheet" href="../style/ticketcart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body>
    <section class="ticketCart">
        <div class="container">
            <!-- Event Image -->
            <div class="imgdiv">
                <img src="../<?php echo htmlspecialchars($eventDetails['event_image']); ?>" alt="<?php echo htmlspecialchars($eventDetails['event_name']); ?>">
            </div>

            <!-- Event Details -->
            <div class="eventDesc">
                <h2 class="eventName" id="eventName"><?php echo htmlspecialchars($eventDetails['event_name']); ?></h2>
                <p class="category">
                    <i class="fa-solid fa-layer-group" style="color:rgb(211, 7, 51); padding:10px;"></i>
                    <?php echo htmlspecialchars($eventDetails['category_name']); ?>
                </p>
                <p class="description">
                    <i class="fa-brands fa-rocketchat" style="color:rgb(211, 7, 51); padding:10px;"></i>
                    <?php echo htmlspecialchars($eventDetails['event_description']); ?>
                </p>
                <p class="eventdate" id="eventDate">
                    <i class="fa-regular fa-clock" style="color: rgb(211, 7, 51); padding:10px;"></i>
                    <?php echo htmlspecialchars($eventDetails['start_date']); ?>
                </p>
                <p class="salleName" id="eventLocation">
                    <i class="fa-solid fa-building" style="color:rgb(211, 7, 51); padding:10px;"></i>
                    <?php echo htmlspecialchars($eventDetails['salle_name']); ?>
                </p>

                <!-- Normal Price -->
                <div class="normalPrice">
                    <p>
                        <i class="fa-solid fa-money-bill-wave" style="color:rgb(211, 7, 51);"></i>
                        Normal Price
                    </p>
                    <div class="pricediv">
                        <i class="fa-solid fa-minus" style="color: rgb(211, 7, 51);" onclick="updatePrice('normal', 'decrease')"></i>
                        <p class="price" id="normalPrice"><?php echo htmlspecialchars($eventDetails['normal_tarif']); ?> DH</p>
                        <i class="fa-solid fa-plus" style="color: rgb(211, 7, 51);" onclick="updatePrice('normal', 'increase')"></i>
                    </div>
                </div>

                <!-- Special Price -->
                <div class="spicealPrice">
                    <p>
                        <i class="fa-solid fa-money-bill-wave" style="color:rgb(211, 7, 51);"></i>
                        Special Price
                    </p>
                    <div class="pricediv">
                        <i class="fa-solid fa-minus" style="color: rgb(211, 7, 51);" onclick="updatePrice('special', 'decrease')"></i>
                        <p class="price" id="specialPrice"><?php echo htmlspecialchars($eventDetails['spicail_tarif']); ?> DH</p>
                        <i class="fa-solid fa-plus" style="color: rgb(211, 7, 51);" onclick="updatePrice('special', 'increase')"></i>
                    </div>
                </div>

                <!-- Get Ticket Form -->
                <form method="POST">

                    <button class="pdfBTN" name="ticketBtn" id="ticketBtn">Get Ticket</button>

                </form>

            </div>
        </div>
    </section>
    <div id="ticketContainer"></div>
    <div id="invoiceContainer"></div>

    <script>
        // Store original prices
        const originalPrices = {
            normal: parseFloat(document.getElementById('normalPrice').textContent.replace(' DH', '')),
            special: parseFloat(document.getElementById('specialPrice').textContent.replace(' DH', ''))
        };

        function updatePrice(type, action) {
            let priceElement = document.getElementById(type === 'normal' ? 'normalPrice' : 'specialPrice');
            if (!priceElement) return;

            let currentPrice = parseFloat(priceElement.textContent.replace(' DH', ''));
            let change = originalPrices[type];
            let newPrice = action === 'increase' ? currentPrice + change : currentPrice - change;

            if (newPrice < 0) newPrice = 0;

            priceElement.textContent = newPrice.toFixed(2) + ' DH';
        }
    </script>
    <script src="../script/pdfcart.js"></script>
</body>

</html>