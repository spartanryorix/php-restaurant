<?php 

function canCancelBooking($diningDate) {
    $diningTimestamp = strtotime($diningDate);
    $diningTimestamp = $diningTimestamp - 7200;
    $currentTimestamp = time();
    
    return $currentTimestamp >= $diningTimestamp;
}
?>