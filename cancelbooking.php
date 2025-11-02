<?php 

    include('database.php');

    if(isset($_GET['tableNum'])) {
        $tableNum = $_GET['tableNum'];

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    
        $stmt = $conn->prepare('UPDATE booking SET booking_free_date = NOW() WHERE table_no = ? ORDER BY id DESC LIMIT 1');
        $stmt->bind_param('i', $tableNum);
        if($stmt->execute()) {
            header('Location: tables.php');
            exit;
        } else {
            echo 'Failed to cancel booking. Please try again.';
        }
    
        $stmt->close();
        $conn->close();
    } else {
        echo 'No table number found.';
    }



?>