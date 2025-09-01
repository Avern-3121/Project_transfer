<?php
    session_start();
    error_reporting(0);
    include_once 'includes/dbconn.php';
    if (strlen($_SESSION['vpmsaid']==0)) {
        header('location:logout.php');
        } else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TMS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="out-vehicle";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">ຈັດການຂໍ້ມູນລົດ ເຂົ້າ-ອອກ</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12"></div>
		</div><!--/.row-->
		
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading"><b>ຂໍ້ມູນລົດ ເຂົ້າ-ອອກ</b></div>
						<div class="panel-body">

                        <!-- ===== Filter Date ===== -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>ເລີ່ມວັນທີ:</label>
                                <input type="date" id="min-date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>ຫາວັນທີ:</label>
                                <input type="date" id="max-date" class="form-control">
                            </div>
                        </div>
                        <!-- ======================= -->

                        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
        <thead>
			<br>
            <tr>
                <th>ລໍາດັບ</th>
                <th>ປ້າຍລົດທາງໜ້າ</th>
                <th>ປ້າຍລົດທາງຫຼັງ</th>
                <th>ພະນັກງານຂັບລົດ</th>
                <th>ລົດຂອງບໍລິສັດ</th>
				<th>ນໍ້າໜັກລົດເຂົ້າ (ໂຕນ)</th>
				<th>ເວລາລົດເຂົ້າ</th>
				<th>ນໍ້າໜັກລົດອອກ (ໂຕນ)</th>
				<th>ເວລາລົດອອກ</th>
				<th>ນໍ້າໜັກແຮ່ທາດ (ໂຕນ)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from entry_trucks_info where Status='1'");
        while ($row=mysqli_fetch_array($ret)) {
        ?>
            <tr>
                <td><?php  echo $row['entry_trucks_id'];?></td>
                <td><?php  echo $row['entry_front_truck_plate'];?></td>
                <td><?php  echo $row['entry_back_truck_plate'];?></td>
                <td><?php  echo $row['entry_truck_driver_name'];?></td>
                <td><?php  echo $row['truck_owner'];?></td>
                <td><?php  echo $row['in_weight'];?></td>
                <td><?php  echo $row['in_time'];?></td>
                <td><?php  echo $row['out_weight'];?></td>
                <td><?php  echo $row['out_time'];?></td>
                <td><?php  echo $row['loading_weight'];?></td>
                <td>
                    <a href="outgoing-truck-detail.php?updateid=<?php echo $row['entry_trucks_id'];?>"><button type="button" class="btn btn-sm btn-info">ເບິ່ງລາຍລະອຽດ</button></a>
                    <center><a href="print-outgoing-truck.php?vid=<?php echo $row['entry_trucks_id'];?>"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-print"></i></button></a></center>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
						</div>
					</div>
				</div>
</div><!--/.row-->
		
        <?php include 'includes/footer.php'?>
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

    <!-- ===== Date Filter Script ===== -->
    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable();

        // เพิ่ม filter function
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var date = data[6]; // index 6 = ເວລາລົດເຂົ້າ

                if (!date) return true;

                var dateObj = new Date(date);
                var minDate = min ? new Date(min) : null;
                var maxDate = max ? new Date(max) : null;

                if ((minDate === null && maxDate === null) ||
                    (minDate === null && dateObj <= maxDate) ||
                    (minDate <= dateObj && maxDate === null) ||
                    (minDate <= dateObj && dateObj <= maxDate)) {
                    return true;
                }
                return false;
            }
        );

        // redraw เมื่อเลือกวันที่
        $('#min-date, #max-date').on('change', function() {
            table.draw();
        });
    });
    </script>
    <!-- ============================ -->
		
</body>
</html>

<?php }  ?>
