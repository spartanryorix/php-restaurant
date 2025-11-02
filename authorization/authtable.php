<?php 
    include('database.php');
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  if (isset($_GET['table'])) {
        $tableDetail = $_GET['table'];
        $table = $tables[$tableDetail];
        $userID = $_SESSION['user_id'];
        
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        
        $stmt = $conn->prepare("SELECT * FROM booking WHERE user_id = ? AND table_no = ? AND booking_free_date IS NULL");
        $stmt->bind_param('ii', $userID, $table['tableNum']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header('Location: tables.php'); 
            exit;
        }
    }
?>
