<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');

    if (strlen($_SESSION['vpmsaid']==0)) {
    header('location:logout.php');
    } else{

    if(isset($_POST['submit-contract']))
    {
		$contract_id=$_POST['contractor_id'];
        $contractor_name=$_POST['contractor_name'];
        $contract_quantity=$_POST['contract_quantity'];
        
        $query=mysqli_query($con, "INSERT into 	contract_info(contract_id, contractor_name, contract_quantity) value('$contract_id','$contractor_name', '$contract_quantity')");
        if ($query) {
        $msg="ສັນຍາໄດ້ຖືກເພີ່ມແລ້ວ";
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
		$page="contract-management";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">ເພີ່ມສັນຍາ</li>
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
						<div class="panel-heading">ເພີ່ມສັນຍາ</div>
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
									<label>ເລກທີສັນຍາ</label>
									<input type="text" class="form-control" placeholder="ພີມເລກທີຂອງສັນຍາ" id="contractor_id" name="contractor_id" required>
								</div>

								<div class="form-group">
									<label>ຊື່ບໍລິສັດຮ່ວມສັນຍາ</label>
									<input type="text" class="form-control" placeholder="ພີມຊື່ບໍລິສັດຮ່ວມສັນຍາ" id="contractor_name" name="contractor_name" required>
								</div>


								<div class="form-group">
									<label>ຈໍານວນແຮ່ທາດ (ໂຕນ)</label>
									<input type="text" class="form-control" placeholder="ພີມຈໍານວນແຮ່ທາດ (ໂຕນ)" id="contract_quantity" name="contract_quantity" required>
								</div>
								

									<button type="submit" class="btn btn-success" name="submit-contract">ເພີ່ມຂໍ້ມູນ</button>
								
								
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