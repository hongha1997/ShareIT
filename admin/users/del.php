<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	$id = 0;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = "SELECT avatar FROM user WHERE user_id = {$id}";
		$result = $mysqli->query($query);
		$ar = mysqli_fetch_assoc($result);
		$fileNameOld = $ar['avatar'];
		if($fileNameOld != ''){
			// xóa file, dùng hàm unlink()
			$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/avatar/'.$fileNameOld;
			unlink($filePath); // truyền vào đường dẫn file đang cần xóa
		}
		$queryDel = "DELETE FROM user WHERE user_id = {$id} ";
		$resultDel = $mysqli->query($queryDel);
		if($resultDel){
			header('location:index.php?msg=Xoá thành công');
			die();
		} else {
			header('location:index.php?msg=Có lỗi trong quá trình xóa');
			die();
		}
	} else { // có thể bỏ else do có die()
		header('location:index.php?msg=Không thể xóa vì không đúng yêu cầu');
		die();
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>