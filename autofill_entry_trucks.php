<?php
session_start();
error_reporting(0);
include('includes/dbconn.php');

// ตั้งค่า Header เพื่อระบุว่าไฟล์นี้จะส่งข้อมูล JSON กลับไป
header('Content-Type: application/json');

// Get the front truck plate from POST request to improve security
// ใช้ $_POST แทน $_REQUEST เพื่อความปลอดภัยและชัดเจน
$front_truck_plate = isset($_POST['front_truck_plate']) ? $_POST['front_truck_plate'] : '';

// เตรียมอาร์เรย์สำหรับเก็บผลลัพธ์
$result = [];

if ($front_truck_plate !== "") {
    // ป้องกัน SQL Injection โดยใช้ Prepared Statements
    // นี่คือวิธีที่ปลอดภัยที่สุดในการจัดการกับข้อมูลที่รับมาจากผู้ใช้
    $stmt = $con->prepare("SELECT back_truck_plate, diver_name, truck_owner FROM truck_info WHERE front_truck_plate = ?");
    $stmt->bind_param("s", $front_truck_plate);
    $stmt->execute();
    $query_result = $stmt->get_result();

    if ($query_result && $query_result->num_rows > 0) {
        $row = $query_result->fetch_assoc();
        // ถ้าพบข้อมูล ให้ดึงค่ามาใส่ในอาร์เรย์
        $result[] = $row["back_truck_plate"];
        $result[] = $row["diver_name"];
        $result[] = $row["truck_owner"];
    }
    // ถ้าไม่พบข้อมูล $result จะเป็นอาร์เรย์ว่าง []
}

// ส่งอาร์เรย์ในรูปแบบ JSON กลับไป
echo json_encode($result);

$con->close();
?>