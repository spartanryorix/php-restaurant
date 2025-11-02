<?php

include('database.php');

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE booking SET booking_free_date = NOW() WHERE dining_date <= NOW() AND booking_free_date IS NULL");
$stmt->execute();

$stmt->close();
?>