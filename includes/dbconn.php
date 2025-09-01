<?php
// dbconn.php
// เชื่อมต่อฐานข้อมูล
$con = mysqli_connect("localhost", "root", "", "parking");

// ตรวจสอบการเชื่อมต่อ
if (mysqli_connect_errno()) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}
?>
