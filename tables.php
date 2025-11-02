<?php 
    define('TITLE', "Abdul Rakeeb's Amazing Dining | Book Tables");
    include('header.php');
?>


<div class="container">
    <div class="row justify-content-center">
        <?php foreach ($tables as $table => $tableNum) { ?>
            <div class="col-md-4 col-sm-6 d-flex justify-content-center mb-3">
                <div class="card tables" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Table <?php echo $tableNum['tableNum']; ?></h5>
                        <p class="card-text"><?php include('tabletextlogic.php'); ?></p>
                        <?php 
                            if ($row && is_null($row['booking_free_date'])) {
                                echo "<a href='booking.php?table=" . $table . "' class='btn btn-primary'>Book Table " . $tableNum['tableNum'] . "</a>";
                            } else {
                                echo "<a href='booking.php?table=" . $table . "' class='btn btn-primary'>Book Table " . $tableNum['tableNum'] . "</a>";
                            }
                        ?>  
                        <?php 
                            if ($row && is_null($row['booking_free_date'])) {
                                if ($row['user_id'] == $_SESSION['user_id'] || $role === 'admin') {
                                    if ($role === 'admin' || canCancelBooking($row['dining_date'])) {
                                        echo "<a href='cancelbooking.php?tableNum=" . $tableNum['tableNum'] . "' class='btn btn-danger mt-3'>Cancel Booking</a>";
                                    } else {
                                        echo "<a class='btn disabled mt-3'>You cannot cancel the booking now</a>";
                                    }
                                }
                            }
                        ?>  

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



</div>
<?php 
    include('footer.php') 
?>