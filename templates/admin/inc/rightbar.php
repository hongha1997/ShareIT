<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar bar1"></span>
			<span class="icon-bar bar2"></span>
			<span class="icon-bar bar3"></span>
		</button>
		<a class="navbar-brand" href="/admin">Trang quản lý</a>
	</div>
	<div class="collapse navbar-collapse">
		<div style="color: black;
		padding: 15px 50px 5px 50px;
		float: right;
		font-size: 16px;">
		<?php
			if(isset($_SESSION['userInfo'])){
				$fullName = $_SESSION['userInfo']['fullname'];
				$hinhanh = $_SESSION['userInfo']['avatar'];
		?>
		Xin chào: <b><?php echo $fullName; ?></b> &nbsp;<img src="/files/avatar/<?php echo $hinhanh; ?>" width="70px" height="70px" />&nbsp; 
		<a href="/auth/logout.php" class="btn btn-danger square-btn-adjust">Đăng xuất</a>
		</div>
		<?php } ?>
	</div>
</div>