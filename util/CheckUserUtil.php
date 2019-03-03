<?php
	if(!isset($_SESSION['userInfo'])) {
		header('location:/auth/login.php');
		die();
	}
?>