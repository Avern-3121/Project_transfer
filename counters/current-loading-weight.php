<?php

    include './includes/dbconn.php';
    
    $sql = "SELECT SUM(loading_weight) FROM entry_trucks_info WHERE out_time >= CURDATE() AND out_time < CURDATE() + INTERVAL 1 DAY";
        $amountsum = mysqli_query($con, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo $row_amountsum['SUM(loading_weight)'];
 ?>