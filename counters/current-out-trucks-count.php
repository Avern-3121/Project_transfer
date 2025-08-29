<?php

    include './includes/dbconn.php';
    //Total Vehicle Entries
    $query=mysqli_query($con,"SELECT entry_trucks_id from entry_trucks_info where date(out_time)=CURDATE();");
    $current_out_trucks=mysqli_num_rows($query);

    echo $current_out_trucks
 ?>