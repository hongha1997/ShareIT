<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	// lấy id -> xóa file nếu có -> xóa tin trong db
	
	
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = "SELECT picture FROM news WHERE news_id = {$id}";
		$result = $mysqli->query($query);
		$ar = mysqli_fetch_assoc($result);
		$fileNameOld = $ar['picture'];
		if($fileNameOld != ''){
			// xóa file, dùng hàm unlink()
			$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileNameOld;
			unlink($filePath); // truyền vào đường dẫn file đang cần xóa
		}
		$queryDel = "DELETE FROM news WHERE news_id = {$id} ";
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