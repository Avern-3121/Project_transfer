<?php

    include './includes/dbconn.php';

    $query=mysqli_query($con,"SELECT entry_trucks_id  from entry_trucks_info where status='1'");
    $count_out_trucks=mysqli_num_rows($query);
    echo $count_out_trucks
 ?>