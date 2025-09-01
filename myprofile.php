<?php
session_start();
error_reporting(0);
include_once 'includes/dbconn.php';

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
    $msg = "";

    if (isset($_POST['submit-profile'])) {
        $adminid = $_SESSION['vpmsaid'];
        $aname = $_POST['adminname'];
        $mobno = $_POST['contactnumber'];

        $query = mysqli_query($con, "UPDATE admin SET AdminName='$aname', MobileNumber='$mobno' WHERE ID='$adminid'");
        if ($query) {
            $msg = "Admin profile has been updated.";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VPS - Admin Profile</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php'; ?>
	<?php include 'includes/sidebar.php'; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="truck_dashboard.php"><em class="fa fa-home"></em></a></li>
				<li class="active">Admin Profile</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Admin Profile</h2>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Profile</div>
			<div class="panel-body">
				<div class="col-md-12">

					<?php if ($msg) { ?>
						<div class="alert alert-info" role="alert">
							<em class="fa fa-lg fa-check">&nbsp;</em> <?php echo $msg; ?>
						</div>
					<?php } ?>

					<form method="POST">
						<div class="row">
						<?php
						$adminid = $_SESSION['vpmsaid'];
						$ret = mysqli_query($con, "SELECT * FROM admin WHERE ID='$adminid'");
						while ($row = mysqli_fetch_array($ret)) {
						?>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Full Name</label>
									<input type="text" class="form-control" name="adminname" value="<?php echo $row['AdminName']; ?>" required>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" value="<?php echo $row['UserName']; ?>" readonly>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" value="<?php echo $row['Email']; ?>" readonly>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label>Contact Number</label>
									<input type="number" class="form-control" name="contactnumber" value="<?php echo $row['MobileNumber']; ?>" required>
								</div>
							</div>
						<?php } ?>
						</div>

						<div class="text-center mt-3">
							<button type="submit" class="btn btn-info" name="submit-profile">Make Changes</button>
						</div>
					</form>
				</div> 
			</div>
		</div>

        <?php include 'includes/footer.php'; ?>
	</div>	
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
<?php } ?>
