<?php
	ob_start();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<?php
	$a = $_POST['data'];
	$query = "SELECT * FROM user WHERE username LIKE '%{$a}%' ";
	$result = $mysqli->query($query);
	while($arNews = mysqli_fetch_assoc($result)){
		$user_id = $arNews['user_id'];
		$username = $arNews['username'];
		$password = $arNews['password'];
		$fullname = $arNews['fullname'];
		$avatar = $arNews['avatar'];	
		$active = $arNews['active'];	
		$type = $arNews['type'];
?>

<tr>
	<td><?php echo $user_id; ?></td>
	<td><?php echo $username; ?></td>
	<td><?php echo $fullname; ?></td>
	<?php 
		if($type==1){
			$chucvu = "Admin";
		} else {
			$chucvu = "Nhân viên";
		}
	?>
	<td><?php echo $chucvu; ?></td>
	<?php 
		if($avatar !=''){ // empty() 
	?>
	<td><img src="/files/avatar/<?php echo $avatar ?>" alt="" width="80px" height="80px" /></td>
	<?php } else {?>
		<td><strong>Không có hình ảnh</strong></td>
	<?php } ?>	
	<td>
	<?php 
		// Khi dang nhap tai khoan la Admindemo thi day la tk demo nen khong duoc thuc hien cac chuc nang
		if($_SESSION['userInfo']['username']!="admindemo"){ 
	?>
		<a href="edit.php"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
		<a href="del.php"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
	<?php } ?>
	</td>
</tr>

<?php } ?>