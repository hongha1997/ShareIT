<?php
	ob_start();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
?>
<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$queryDel = "DELETE FROM cat_list WHERE cat_id = {$id} ";
		$resultDel = $mysqli->query($queryDel);
		$queryDel2 = "DELETE FROM cat_list WHERE parent_id = {$id} ";
		$resultDel2 = $mysqli->query($queryDel2);
		if($resultDel&&resultDel2){
			
			$query3 = "SELECT picture FROM news WHERE cat_id = {$id}";
			$result3 = $mysqli->query($query3);
			while($ar3 = mysqli_fetch_assoc($result3)){
				$fileNameOld = $ar3['picture'];
				if($fileNameOld != ''){
					// xóa file, dùng hàm unlink()
					$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileNameOld;
					unlink($filePath); // truyền vào đường dẫn file đang cần xóa
				}
			}
			$query2 = "DELETE FROM news WHERE cat_id = {$id}";
			$result2 = $mysqli->query($query2);	
			
			header('location:index.php?msg=Xoá thành công');
			die();
		} else {
			header('location:index.php?msg=Có lỗi trong quá trình xóa');
			die();
		}
	} else {
		header('location:index.php?msg=Không thể xóa vì không đúng yêu cầu');
		die();
	}
?>
<?php
	ob_end_flush();
?>