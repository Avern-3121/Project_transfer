<?php
	session_start();
	error_reporting(0);
	include_once 'includes/dbconn.php';
	if (strlen($_SESSION['vpmsaid']==0)) {
	header('location:logout.php');
	} else {  ?>
<?php
	if(isset($_POST['submit-entry-trucks'])) {
		$front_truck_plate=$_POST['front_truck_plate'];
		$back_truck_plate=$_POST['back_truck_plate'];
		$diver_name=$_POST['diver_name'];
		$truck_owner=$_POST['truck_owner'];
		$in_weight=$_POST['in_weight'];
			
		$query=mysqli_query($con, "INSERT into entry_trucks_info (entry_front_truck_plate, entry_back_truck_plate, entry_truck_driver_name, truck_owner, in_weight) value('$front_truck_plate','$back_truck_plate','$diver_name','$truck_owner','$in_weight')");
		if ($query) {
			echo "<script>alert('ລາຍລະອຽດຂອງລົດເຂົ້າ ໄດ້ຖືກເພີ່ມແລ້ວ');</script>";
			echo "<script>window.location.href ='truck_dashboard.php'</script>";
		} else {
			echo "<script>alert('ມີບາງຢ່າງຜິດພາດ');</script>";
		}
	}
  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TMS</title>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>			
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
		$page="in-trucks";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">ຈັດການລົດເຂົ້າ</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">

			</div>
		</div><!--/.row-->
		
		<div class="panel panel-default">
					<div class="panel-heading">ບັນທຶກລົດເຂົ້າ</div>
					<div class="panel-body">

						<div class="col-md-12">

							<form method="POST">

								<div class="form-group">
									<label>ປ້າຍລົດທາງໜ້າ</label>
									<input type="text" class="form-control" placeholder="ປ້າຍລົດທາງໜ້າ" id="front_truck_plate" name="front_truck_plate" onkeyup="GetDetail(this.value)" value="" required>
								</div>


								<div class="form-group">
									<label>ປ້າຍລົດທາງຫຼັງ</label>
									<input type="text" class="form-control" placeholder="ປ້າຍລົດທາງຫຼັງ" id="back_truck_plate" name="back_truck_plate" value="" readonly required>
								</div>

								<div class="form-group">
									<label>ພະນັກງານຂັບລົດ</label>
									<input type="text" class="form-control" placeholder="ພະນັກງານຂັບລົດ" id="diver_name" name="diver_name" value="" readonly required>
								</div>
												

								<div class="form-group">
									<label>ລົດຂອງບໍລິສັດ</label>
									<input type="text" class="form-control" placeholder="ລົດຂອງບໍລິສັດ" id="truck_owner" name="truck_owner" value="" readonly required>
								</div>


								<div class="form-group">
									<label>ນໍ້າໜັກລົດເຂົ້້າ</label>
									<input type="text" class="form-control" placeholder="ນໍ້າໜັກລົດເຂົ້້າ" maxlength="10" pattern="[0-9]+" id="in_weight" name="in_weight" required>
								</div>


									<button type="submit" class="btn btn-success" name="submit-entry-trucks">ບັນທຶກ</button>
								</div> <!--  col-md-12 ends -->
							</form>
						</div> 
					</div>

 <script>
        // onkeyup event will occur when the user 
        // release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("back_truck_plate").value = "";
                document.getElementById("diver_name").value = "";
				document.getElementById("truck_owner").value = "";

                return;
            }
            else {

                // Creates a new XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {

                    // Defines a function to be called when
                    // the readyState property changes
                    if (this.readyState == 4 && 
                            this.status == 200) {
                        
                        // Typical action to be performed
                        // when the document is ready
                        var myObj = JSON.parse(this.responseText);

                        // Returns the response data as a
                        // string and store this array in
                        // a variable assign the value 
                        // received to first name input field
                        
                        document.getElementById("back_truck_plate").value = myObj[0];
                        
                        // Assign the value received to
                        // last name input field
                        document.getElementById("diver_name").value = myObj[1];
						// Assign the value received to
                        // last name input field
                        document.getElementById("truck_owner").value = myObj[2];
                    }
                };

                // xhttp.open("GET", "filename", true);
                xmlhttp.open("POST", "autofill_entry_trucks.php?front_truck_plate=" + str, true);
                
                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>
		
		
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