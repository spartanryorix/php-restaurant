<?php 
    include('database.php'); // Make sure this file has your database connection

    $conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);

    define('TITLE', "Tables | Abdul Rakeeb's Amazing Dining");
    include('header.php');
    include('authorization/authtable.php');

    if(isset($_GET['table'])) {
        $tableDetail = $_GET['table'];
        $table = $tables[$tableDetail];
    }
?>
<?php
    if(isset($_POST['submit'])) {
        
        $error = "";
        $seats = $_POST['seats'];
        $diningDate = $_POST['diningDate'];

        if(empty($diningDate) || empty($seats)) {
            $error = "Please fill in the required fields.";
        } else {    
            // Convert the dining date to just the date (no time) for comparison
            $diningDateOnly = date('Y-m-d', strtotime($diningDate));
            $userID = $_SESSION['user_id'];
            $tableNum = $table['tableNum'];

            // Check if the table is already booked for the same date (no time)
            $stmt = $conn->prepare("SELECT * FROM booking WHERE table_no = ? AND DATE(dining_date) = ?");
            $stmt->bind_param('is', $tableNum, $diningDateOnly);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Date is already booked for this table
                $error = "Sorry, this table is already booked for that date!";
            } else {
                // Proceed with booking
                $stmt = $conn->prepare("INSERT INTO booking (user_id, table_no, no_of_seats, dining_date) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('iiis', $userID, $tableNum, $seats, $diningDate);
                if($stmt->execute()) {
                    header('Location: tables.php');
                    exit;
                } else {
                    echo 'Failed to book table, please try again.';
                }
            }
            
            $stmt->close();
        }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card tables" style="width: 36rem;">
            <div class="row">
                <div class="col-md-6 p-3">
                    <form method="post" action="">
                        <div class="d-flex align-items-center">
                            <a href="tables.php" class="me-3"><i class="bi bi-arrow-left"></i></a>
                        </div>
                        <h1 class="text-center">Book Table <?php echo $table['tableNum'] ?></h1>
                        <input class='form-control' name="seats" type="number" min="1" max="6" placeholder="Select the number of seats">
                        <span class="form-text" id="min&max" style="color: gray;">Minimum: 1, Maximum: 6</span><br>
                        <input class='form-control mt-2' name="diningDate" id="dateInput" type="date" placeholder="Choose the booking date"><br>
                        <button class="btn btn-success w-100 mt-2" type="submit" name="submit">Reserve Table <?php echo $table['tableNum'] ?></button>
                        <?php if (!empty($error)) { ?>
                            <div class="text-center mt-2" style="color:red;"><b><?php echo $error; ?></b></div>
                        <?php } ?>
                    </form>
                </div>

                <div class="col-md-6 p-3 border-start">
                    <h3 class="text-center">Booked Dates</h3>
                    <ul class=" card tables">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM booking WHERE table_no = ? AND booking_free_date IS NULL ORDER BY id DESC LIMIT 1");
                        $stmt->bind_param('i', $table['tableNum']);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<li class='list-group-item text-center'>" .  date('Y-m-d H:i', strtotime($row['dining_date'])) . "</li>";
                            }
                        } else {
                            echo "<li class='list-group-item text-center'>No bookings yet.</li>";
                        }
                        $stmt->close();
                        $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
    include('footer.php')
?>