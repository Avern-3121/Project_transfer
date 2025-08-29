<?php
    session_start();
    error_reporting(0);

    include('includes/dbconn.php');
    if (strlen($_SESSION['vpmsaid']==0)) {
    header('location:logout.php');
    } else{

    if(isset($_POST['update-truck-info']))
    {
        $aid=$_SESSION['vpmsaid'];
        $back_truck_plate=$_POST['back_truck_plate'];
		$diver_name=$_POST['diver_name'];
    	$eid=$_GET['editid'];
    
        $query=mysqli_query($con, "UPDATE truck_info set back_truck_plate='$back_truck_plate', diver_name='$diver_name' where front_truck_plate='$eid'");
        if ($query) {
        $msg="ຂໍ້ມູນຂອງລົດ ໄດ້ຖືກແກ້ໄຂສຳເລັດແລ້ວ.";
    }
    else
        {
        $msg="ຂໍ້ມູນບໍ່ຖືກຕ້ອງ ກະລະນາກວດຄືນ.";
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
				<li class="active">ຈັດການຂໍ້ມູນລົດ</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-default">
					<div class="panel-heading">ແກ້ໄຂຂໍ້ມູນລົດ</div>
					<div class="panel-body">

						<div class="col-md-12">

                        <?php if($msg)
						echo "<div class='alert bg-info' role='alert'>
						<em class='fa fa-lg fa-warning'>&nbsp;</em> 
						$msg
						<a href='#' class='pull-right'>
						<em class='fa fa-lg fa-close'>
						</em></a></div>" ?> 

							<form method="POST">

                            <?php
                            $cid=$_GET['editid'];
                            $ret=mysqli_query($con,"SELECT * from  truck_info where front_truck_plate='$cid'");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {

                            ?>  

								<div class="form-group">
									<label>ປ້າຍລົດທາງຫຼັງ</label>
									<input type="text" class="form-control" placeholder="ຊື່ບໍລິສັດ" value="<?php  echo $row['back_truck_plate'];?>" id="back_truck_plate" name="back_truck_plate" required>
								</div>
								<div class="form-group">
									<label>ພະນັກງານຂັບລົດ</label>
									<input type="text" class="form-control" placeholder="ຊື່ບໍລິສັດ" value="<?php  echo $row['diver_name'];?>" id="diver_name" name="diver_name" required>
								</div>

                            <?php }?>

									<button type="submit" class="btn btn-success" name="update-truck-info">ແກ້ໄຂ</button>
								</div> <!--  col-md-12 ends -->
							</form>
						</div> 
					</div>
		
		
		

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
		
</body>
</html>

<?php }  ?>