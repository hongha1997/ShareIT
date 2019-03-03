<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	$id = 0;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	$queryDel = "DELETE FROM contact WHERE id_contact = {$id}";
	$resultDel = $mysqli->query($queryDel);
	if($resultDel){
		header("location:index.php?msg=Xóa thành công");
		return;
	} else {
		header("location:index.php?msg=Có lỗi trong quá trình xử lý!");
		return;
	}	
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>