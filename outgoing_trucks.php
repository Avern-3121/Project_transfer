<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    if (strlen($_SESSION['vpmsaid']==0)) {
        header('location:logout.php');
        } else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Truck Management System</title>
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
		$page="outgoing_trucks";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">ຈັດການລົດອອກ</li>
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
						<div class="panel-heading">ບັນທຶກລົດອອກ</div>
						<div class="panel-body">
                        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
                        
        <thead>
            <tr>
                <th>ລໍາດັບ</th>
                <th>ປ້າຍລົດທາງໜ້າ</th>
                <th>ປ້າຍລົດທາງຫຼັງ</th>
                <th>ພະນັກງານຂັບລົດ</th>
                <th>ລົດຂອງບໍລິສັດ</th>
                <th>ນໍ້າໜັກລົດເຂົ້້າ</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * FROM entry_trucks_info WHERE Status='' ORDER BY in_time DESC");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

        ?>
   
            <tr>

            <td><?php  echo $row['entry_trucks_id'];?></td>
            <td><?php  echo $row['entry_front_truck_plate'];?></td>
            <td><?php  echo $row['entry_back_truck_plate'];?></td>

            <td><?php  echo $row['entry_truck_driver_name'];?></td>

            <td><?php  echo $row['truck_owner'];?></td>
            <td><?php  echo $row['in_weight'];?></td>
            
            <td><a href="update-outgoing_truck.php?updateid=<?php echo $row['entry_trucks_id'];?>"><button type="button" class="btn btn-sm btn-danger">ດໍາເນີນການ</button></a>
            </td>

            </tr>

                <?php $cnt=$cnt+1;}?>
 
        
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