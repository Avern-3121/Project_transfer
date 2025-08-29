<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');

    if (strlen($_SESSION['vpmsaid']==0)) {
    header('location:logout.php');
    } else{

    if(isset($_POST['submit_truck_info']))
    {
		$front_truck_plate=$_POST['front_truck_plate'];
        $back_truck_plate=$_POST['back_truck_plate'];
        $diver_name=$_POST['diver_name'];
        $truck_owner=$_POST['truck_owner'];
        
        
        $query=mysqli_query($con, "INSERT into 	truck_info(front_truck_plate, back_truck_plate, diver_name, truck_owner) value ('$front_truck_plate','$back_truck_plate', '$diver_name', '$truck_owner')");
        if ($query) {
        $msg="ລົດບັນທຸກໄດ້ຖືກເພີ່ມແລ້ວ";
    }
    else
        {
        $msg="ຂໍ້ມູນບໍ່ຖືກຕ້ອງ ກະລະນາກວດຄືນ";
        }

    
    }
  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VPS</title>
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
		$page="truck-management";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">ເພີ່ມລົດບັນທຸກ</li>
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
						<div class="panel-heading">ເພີ່ມລົດບັນທຸກ</div>
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
								<div class="form-group">
									<label>ປ້າຍລົດທາງໜ້າ</label>
									<input type="text" class="form-control" placeholder="ພີມປ້າຍລົດທາງໜ້າ" id="front_truck_plate" name="front_truck_plate" required>
								</div>

								<div class="form-group">
									<label>ປ້າຍລົດທາງຫຼັງ</label>
									<input type="text" class="form-control" placeholder="ພີມປ້າຍລົດທາງຫຼັງ" id="back_truck_plate" name="back_truck_plate" required>
								</div>

								<div class="form-group">
									<label>ພະນັກງານຂັບລົດ</label>
									<input type="text" class="form-control" placeholder="ພີມຊື່ພະນັກງານຂັບລົດ" id="diver_name" name="diver_name" required>
								</div>

								<!--<div class="form-group">
									<label>ລົດຂອງບໍລິສັດ</label>
								<input type="text" class="form-control" placeholder="ພີມຊື່ຂອງບໍລິສັດລົດ" id="truck_owner" name="truck_owner" required>
								</div>-->
								<div class="form-group">
									<label>ລົດຂອງບໍລິສັດ</label>
									<select class="form-control" name="truck_owner" id="truck_owner">
									<option value="0">ເລືອກບໍລິສັດ</option>
									<?php $query=mysqli_query($con,"select * from contract_info");
										while($row=mysqli_fetch_array($query))
										{
										?>    
                                        <option value="<?php echo $row['contractor_name'];?>"><?php echo $row['contractor_name']; ?></option>
                  						<?php } ?> 
										</select>
								</div>
								</select>
								
								

									<button type="submit" class="btn btn-success" name="submit_truck_info">ເພີ່ມຂໍ້ມູນ</button>
								
								
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