<?php

    include './includes/dbconn.php';

    $query=mysqli_query($con,"SELECT entry_trucks_id  from  entry_trucks_info where status='0'");
    $count_in_trucks=mysqli_num_rows($query);

    echo $count_in_trucks
 ?>