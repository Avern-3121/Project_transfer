<?php

    include './includes/dbconn.php';

    $query=mysqli_query($con,"SELECT front_truck_plate from  truck_info");
    $trucks_count=mysqli_num_rows($query);

    echo $trucks_count
 ?>