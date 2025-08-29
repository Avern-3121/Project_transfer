<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');

    if (strlen($_SESSION['vpmsaid']==0)) {
    header('location:logout.php');
    } else {

    if(isset($_POST['submit-in'])){
        $cid=$_GET['updateid'];
        $remark=$_POST['remark'];
        $status=$_POST['status'];
        $parkingcharge=$_POST['parkingcharge'];
    
        $query=mysqli_query($con, "UPDATE vehicle_info set Remark='$remark',Status='$status',ParkingCharge='$parkingcharge' where entry_trucks_id='$cid'");
        if ($query) {
            $msg="All remarks has been updated.";
        } else {
            $msg="Something Went Wrong";
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
				<li class="active">ລາຍລະອຽດຂໍ້ມູນລົດ ເຂົ້າ-ອອກ</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">ລາຍລະອຽດລົດ ເຂົ້າ-ອອກ</div>
						<div class="panel-body">

                        <?php if($msg)
						echo "<div class='alert bg-info ' role='alert'>
						<em class='fa fa-lg fa-warning'>&nbsp;</em> 
						$msg
						<a href='#' class='pull-right'>
						<em class='fa fa-lg fa-close'>
						</em></a></div>" ?> 
                        
                        <div class="col-md-12">


							<form method="POST">


                            <?php
                            $cid=$_GET['updateid'];
                            $ret=mysqli_query($con,"SELECT * from entry_trucks_info where entry_trucks_id='$cid'");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {

                            ?> 

								<div class="form-group">
									<label>ເລກທີ</label>
									<input type="text" class="form-control" value="<?php  echo $row['entry_trucks_id'];?>" id="sdesc" name="sdesc" readonly>
								</div>


								<div class="form-group">
									<label>ປ້າຍລົດທາງໜ້າ</label>
									<input type="text" class="form-control" value="<?php  echo $row['entry_front_truck_plate'];?>" id="entry_front_truck_plate" name="entry_front_truck_plate" readonly>
								</div>


                                <div class="form-group">
									<label>ປ້າຍລົດທາງຫຼັງ</label>
									<input type="text" class="form-control" value="<?php  echo $row['entry_truck_driver_name'];?>" id="entry_truck_driver_name" name="entry_truck_driver_name" readonly>
								</div>

								<div class="form-group">
									<label>ພະນັກງານຂັບລົດ</label>
									<input type="text" class="form-control" value="<?php  echo $row['entry_truck_driver_name'];?>" id="entry_truck_driver_name" name="entry_truck_driver_name" readonly>
								</div>

                                <div class="form-group">
									<label>ລົດຂອງບໍລິສັດ</label>
									<input type="text" class="form-control" value="<?php  echo $row['truck_owner'];?>" id="truck_owner" name="truck_owner" readonly>
								</div>


                                <div class="form-group">
									<label>ນໍ້າໜັກລົດເຂົ້້າ</label>
									<input type="text" class="form-control" value="<?php  echo $row['in_weight'];?>" id="in_weight" name="in_weight" readonly>
								</div>


                                <div class="form-group">
									<label>ເວລາລົດເຂົ້າ</label>
									<input type="text" class="form-control" value="<?php  echo $row['in_time'];?>" id="in_time" name="in_time" readonly>
								</div>


                                <div class="form-group">
									<label>ນໍ້າໜັກລົດອອກ</label>
									<input type="text" class="form-control" value="<?php  echo $row['out_weight'];?>" id="out_weight" name="out_weight" readonly>
								</div>


								<div class="form-group">
									<label>ເວລາລົດອອກ</label>
									<input type="text" class="form-control" value="<?php  echo $row['out_time'];?>" id="out_time" name="out_time" readonly>
								</div>
								<div class="form-group">
									<label>ນໍ້າໜັກແຮ່ທາດ</label>
									<input type="text" class="form-control" value="<?php  echo $row['loading_weight'];?>" id="loading_weight" name="loading_weight" readonly>
								</div>

                                <div class="form-group">
									<label>ສະຖານະລົດ</label>
									<input type="text" class="form-control" value="<?php if($row['status']=="0"){ echo "ລົດເຂົ້າ"; } if($row['status']=="1"){echo "ລົດອອກ";} ;?>" id="sdesc" name="sdesc" readonly>
								</div>

								
                        <?php } ?>

									
                                    
								</div> <!--  col-md-12 ends -->


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
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true,
		scaleLineColor: "rgba(0,0,0,.2)",
		scaleGridLineColor: "rgba(0,0,0,.05)",
		scaleFontColor: "#c5c7cc"
		});
};
	</script>

    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
		
</body>
</html>

<?php }  ?>