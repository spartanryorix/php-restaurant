<?php 
    include('database.php');
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    $stmt = $conn->prepare("SELECT * FROM booking WHERE table_no = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $tableNum['tableNum']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && is_null($row['booking_free_date']) && $row['user_id'] == $_SESSION['user_id']) {
        echo "<p class='card-text' style='color: yellow;'>You booked this table for<br>" . date('Y-m-d H:i', strtotime($row['dining_date'])) . "</p>";
    } /*elseif (($row && is_null($row['booking_free_date']))) {
        echo "<p class='card-text' style='color: rgb(255, 0, 0);'>Sorry, this table is borrowed. Booking will be free at <br>" . date('Y-m-d H:i', strtotime($row['dining_date'])) . "</p>";
    }*/ else {
        echo "<p class='card-text' style='color: rgb(30, 255, 0);'>Reserve this table now!</p>";
    }
?>