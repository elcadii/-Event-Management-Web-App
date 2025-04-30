<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    include("connectdb.php");
    include("header.php");

    // Get user information
    $user_id = $_SESSION['user_id'];
    $getUserInfo = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($getUserInfo);
    $stmt->execute(['user_id' => $user_id]);
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get user's reservations with event details
    $getReservations = "SELECT r.*, e.event_name, e.event_image, e.start_date, e.normal_tarif, e.spicail_tarif,
                       s.salle_name, c.category_name
                       FROM resrvtion r
                       INNER JOIN evente e ON r.event_id = e.event_id
                       INNER JOIN salle s ON e.salle_id = s.salle_id
                       INNER JOIN category c ON e.category_id = c.category_id
                       WHERE r.user_id = :user_id
                       ORDER BY r.date_now DESC";
    $stmt = $pdo->prepare($getReservations);
    $stmt->execute(['user_id' => $user_id]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("location: http://localhost/events/php/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../style/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="profile-container">
        <div class="user-info">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fa-solid fa-user-circle"></i>
                </div>
                <h2><?php echo htmlspecialchars($userInfo['first_name'] . ' ' . $userInfo['last_name']); ?></h2>
                <p class="email"><i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($userInfo['email']); ?></p>
            </div>
        </div>

        <div class="reservations-section">
            <h3>My Reservations</h3>
            <div class="reservations-grid">
                <?php if (count($reservations) > 0): ?>
                    <?php foreach ($reservations as $reservation): ?>
                        <div class="reservation-card">
                            <div class="event-image">
                                <img src="../<?php echo htmlspecialchars($reservation['event_image']); ?>" alt="<?php echo htmlspecialchars($reservation['event_name']); ?>">
                            </div>
                            <div class="event-details">
                                <h4><?php echo htmlspecialchars($reservation['event_name']); ?></h4>
                                <p><i class="fa-solid fa-calendar"></i> <?php echo date('F j, Y', strtotime($reservation['start_date'])); ?></p>
                                <p><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($reservation['salle_name']); ?></p>
                                <p><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($reservation['category_name']); ?></p>
                                <div class="ticket-info">
                                    <?php if ($reservation['normal_tarif'] > 0): ?>
                                        <p>Normal Tickets: <?php echo $reservation['normal_tarif']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($reservation['spicail_tarif'] > 0): ?>
                                        <p>Special Tickets: <?php echo $reservation['spicail_tarif']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <p class="reservation-date">Reserved on: <?php echo date('F j, Y', strtotime($reservation['date_now'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-reservations">
                        <p>You haven't made any reservations yet.</p>
                        <a href="ticket.php" class="browse-events">Browse Events</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
