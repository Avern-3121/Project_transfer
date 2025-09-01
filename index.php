<?php
session_start();
error_reporting(0);
include_once 'includes/dbconn.php';
error_reporting(0);

if (isset($_POST['login'])) {
    $adminuser = mysqli_real_escape_string($con, $_POST['username']);
    $password  = md5($_POST['password']); // ใช้ md5 ตามที่ตาราง admin เก็บไว้

    $query = mysqli_query($con, "SELECT ID FROM admin WHERE UserName='$adminuser' AND Password='$password'");
    $ret = mysqli_fetch_array($query);

    if ($ret) {
        $_SESSION['vpmsaid'] = $ret['ID'];
        header('location:truck_dashboard.php');
        exit();
    } else {
        $msg = "❌ Login Failed !!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style> 
		@font-face {
		   font-family: myFirstFont;
		   src: url(fonts/NotoSansLao.ttf);
		}
		* {
		   font-family: myFirstFont;
		}
	</style>
	<title>ລະບົບຈັດການລົດບັນທຸກແຮ່ທາດ</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "parking");

$msg = ""; // สำหรับเก็บข้อความ error

if (isset($_POST['login'])) {
    $adminuser = $_POST['username'];
    $password  = $_POST['password'];

    // ตรวจสอบว่ามี username/password นี้หรือไม่
    $sql = "SELECT id FROM users WHERE username='$adminuser' AND password='$password' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) < 0) {
        $_SESSION['username'] = $adminuser;
        header("Location: truck_dashboard.php"); // เมื่อ login สำเร็จ ไปหน้า dashboard
        exit();
    } else {
        $msg = "❌ ชื่อผู้ใช้หรือรหัสผ่านผิด";
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <center><h2><b>ລະບົບຈັດການລົດບັນທຸກແຮ່ທາດ</b></h2></center>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <center><b>ປ້ອນຊໍ້ມູນເພື່ອເຂົ້າໃຊ້ລະບົບ</b></center>
                </div>
                <div class="panel-body">
                    <form method="POST">
                        <?php if (!empty($msg)) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $msg ?>
                            </div>
                        <?php } ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="ຊື່ຜູ້ໃຊ້" name="username" type="text" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ລະຫັດຜ່ານ" name="password" type="password" required>
                            </div>
                            <center>
                                <button class="btn btn-success" type="submit" name="login"><b>ເຂົ້າໃຊ້ລະບົບ</b></button>
                            </center>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>  
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
