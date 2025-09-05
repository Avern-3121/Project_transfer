<?php
session_start();
// เปิดใช้งานการแสดงข้อผิดพลาดเพื่อช่วยในการแก้ไขปัญหา
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'includes/dbconn.php';

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // กำหนดวันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
    $current_date = date('Y-m-d');

    // ดึงข้อมูลน้ำหนักรวมของแต่ละบริษัทสำหรับวันปัจจุบัน
    $company_data = [];
    $company_labels = [];
    $company_query = mysqli_query($con, "SELECT truck_owner, SUM(out_weight - in_weight) AS total_weight 
                                        FROM entry_trucks_info 
                                        WHERE DATE(out_time) = '$current_date' AND out_weight > 0 
                                        GROUP BY truck_owner");
    
    if ($company_query) {
        while ($row = mysqli_fetch_assoc($company_query)) {
            $company_labels[] = $row['truck_owner'];
            $company_data[] = (float)$row['total_weight'];
        }
    }

    // ดึงข้อมูลน้ำหนักรวมของรถแต่ละคัน เรียงจากมากไปหาน้อยสำหรับวันปัจจุบัน
    $truck_data = [];
    $truck_labels = [];
    $truck_query = mysqli_query($con, "SELECT entry_front_truck_plate, (out_weight - in_weight) AS total_weight 
                                     FROM entry_trucks_info 
                                     WHERE DATE(out_time) = '$current_date' AND out_weight > 0 
                                     ORDER BY total_weight DESC");

    if ($truck_query) {
        while ($row = mysqli_fetch_assoc($truck_query)) {
            $truck_labels[] = $row['entry_front_truck_plate'];
            $truck_data[] = (float)$row['total_weight'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php' ?>
    
    <?php
    $page="truck_dashboard";
    include 'includes/sidebar.php'
    ?>
    
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">ໜ້າສະແດງຜົນ</li>
            </ol>
        </div><div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-car color-blue"></em>
                            <div class="large"><?php include 'counters/trucks-count.php'?></div>
                            <div class="text-muted">ຈໍານວນລົດທັງໝົດ</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-toggle-on color-orange"></em>
                            <div class="large"><?php include 'counters/in-trucks-count.php'?></div>
                            <div class="text-muted">ຈໍານວນລົດເຂົ້າ ລໍຖ້າແຮ່ຂຶ້ນ</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-toggle-off color-teal"></em>
                            <div class="large"><?php include 'counters/out-trucks-count.php'?></div>
                            <div class="text-muted">ຈໍານວນລົດ ເຂົ້າ-ອອກ ທັງໝົດ</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-clock-o color-red"></em>
                            <div class="large"><?php include 'counters/current-out-trucks-count.php'?></div>
                            <div class="text-muted"><b>ຈໍານວນລົດ ອອກ ພາຍໃນ 24 ຊົ່ວໂມງ</b></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-clock-o color-red"></em>
                            <div class="large"><?php include 'counters/current-loading-weight.php'?></div>
                            <div class="text-muted"><b>ຈໍານວນແຮ່ສົ່ງອອກພາຍໃນ 24 ຊົ່ວໂມງ (ໂຕ່ນ)</b></div>
                        </div>
                    </div>
                </div>
            </div></div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Highlights - Truck Company
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="companyChart" height="160" ></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Highlights - Top Trucks
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="truckChart" height="160" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php include 'includes/footer.php'?>
    </div>  <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
    <script>
        window.onload = function () {
            // Chart for Truck Companies
            var ctx_company = document.getElementById("companyChart").getContext('2d');
            var companyChart = new Chart(ctx_company, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($company_labels); ?>,
                    datasets: [{
                        label: 'Total Weight (Tons)',
                        backgroundColor: "#30a5ff",
                        data: <?php echo json_encode($company_data); ?>
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            // Chart for Top Trucks
            var ctx_truck = document.getElementById("truckChart").getContext('2d');
            var truckChart = new Chart(ctx_truck, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($truck_labels); ?>,
                    datasets: [{
                        label: 'Total Weight (Tons)',
                        backgroundColor: "#f5c542",
                        data: <?php echo json_encode($truck_data); ?>
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        };
    </script>
</body>
</html>

<?php } ?>