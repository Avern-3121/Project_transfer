
<?php
session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    
// Get the front truck plate id 
$front_truck_plate = $_REQUEST['front_truck_plate'];

if ($front_truck_plate !== "") {
    
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT back_truck_plate, diver_name, truck_owner FROM truck_info WHERE front_truck_plate='$front_truck_plate'");

    $row = mysqli_fetch_array($query);

    // Get the back plate 
    $back_truck_plate = $row["back_truck_plate"];
    // Get the driver name
    $diver_name = $row["diver_name"];
    // Get the truck owner
    $truck_owner = $row["truck_owner"];
}

// Store it in a array
$result = array("$back_truck_plate", "$diver_name", "$truck_owner");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>