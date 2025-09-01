<style> 
@font-face {
   font-family: myFirstFont;
   src: url(fonts/NotoSansLao.ttf);
}

*{
   font-family: myFirstFont;
}
</style>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar"  font-family: myFirstFont;>
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="https://www.w3schools.com/howto/img_avatar.png" width="50" class="img-responsive" alt="Icon">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<ul class="nav menu">
			<li class="<?php if($page=="truck_dashboard") {echo "active";}?>"><a href="truck_dashboard.php"><em class="fa fa-dashboard">&nbsp;</em><b> ໜ້າສະແດງຜົນ</b></a></li>
			<li class="<?php if($page=="contract-management") {echo "active";}?>"><a href="contract-management.php"><em class="fa fa-th-large">&nbsp;</em><b> ຈັດການສັນຍາ</b></a></li>
			<li class="<?php if($page=="truck-management") {echo "active";}?>"><a href="truck-management.php"><em class="fa fa-th-large">&nbsp;</em> <b>ຈັດການລົດບັນທຸກ</b></a></li>
			<li class="<?php if($page=="in-trucks") {echo "active";}?>"><a href="in-trucks.php"><em class="fa fa-car">&nbsp;</em><b> ບັນທຶກລົດເຂົ້າ</b></a></li>
			<li class="<?php if($page=="outgoing_trucks") {echo "active";}?>"><a href="outgoing_trucks.php"><em class="fa fa-toggle-on">&nbsp;</em> <b>ບັນທຶກລົດອອກ</b></a></li>
			<li class="<?php if($page=="out-vehicle") {echo "active";}?>"><a href="out-trucks.php"><em class="fa fa-toggle-off">&nbsp;</em> <b>ຂໍ້ມູນລົດ ເຂົ້າ-ອອກ</b></a></li>
			<li class="<?php if($page=="total-loading-weight") {echo "active";}?>"><a href="total-loading-weight.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck-front-fill" viewBox="0 0 16 16">
  				<path d="M3.5 0A2.5 2.5 0 0 0 1 2.5v9c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2v-9A2.5 2.5 0 0 0 12.5 0zM3 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3.9c0 .625-.562 1.092-1.17.994C10.925 7.747 9.208 7.5 8 7.5s-2.925.247-3.83.394A1.008 1.008 0 0 1 3 6.9zm1 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2m8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2m-5-2h2a1 1 0 1 1 0 2H7a1 1 0 1 1 0-2"/>
				</svg>&nbsp;&nbsp;<b>ຈ/ນ ແຮ່ທີ່ສົ່ງອອກທັງໝົດ</b></a></li>
			<li class="<?php if($page=="reports") {echo "active";}?>"><a href="reports.php"><em class="fa fa-file">&nbsp;</em> <b>ລາຍງານ</b></a></li>
			
		</ul>
		
	</div><!--/.sidebar-->