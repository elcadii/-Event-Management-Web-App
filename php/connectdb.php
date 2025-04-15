<?php
session_start();
$sdn = "mysql:host=localhost;dbname=events_mangment";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($sdn, $user, $pass);

    // echo "Connected successfully"; 

} catch (PDOException $e) {
  echo "Connection error: " . $e->getMessage();
}
?>