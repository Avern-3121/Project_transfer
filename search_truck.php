<?php
include_once 'includes/dbconn.php';

$term = $_GET['term'] ?? '';

$result = mysqli_query($con, "SELECT entry_front_truck_plate 
                              FROM entry_trucks_info 
                              WHERE entry_front_truck_plate LIKE '%$term%' 
                              LIMIT 10");

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['entry_front_truck_plate'];
}

echo json_encode($data);
?>
