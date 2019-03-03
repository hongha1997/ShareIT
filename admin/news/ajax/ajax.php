<?php
	ob_start();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<?php
	$a = $_POST['data'];
	$query = "SELECT * FROM news as n INNER JOIN cat_list as c ON n.cat_id = c.cat_id WHERE n.news_name LIKE '%{$a}%'";
	$result = $mysqli->query($query);
	while($arNews = mysqli_fetch_assoc($result)){
		$news_id = $arNews['news_id'];
		$news_name = $arNews['news_name'];
		$news_preview = $arNews['news_preview'];
		$news_detail = $arNews['news_detail'];
		$date_create = $arNews['date_create'];	
		$created_by = $arNews['created_by'];	
		$picture = $arNews['picture'];	
		$cat_id = $arNews['cat_id'];	
		$is_slide = $arNews['is_slide'];
		$cat_name = $arNews['cat_name'];
?>

<tr>
	<td><?php echo $news_id; ?></td>
	<td><?php echo $news_name; ?></td>
	<td><?php echo $cat_name; ?></td>
	<?php 
		if($picture !=''){ 
	?>
	<td><img src="/files/<?php echo $picture ?>" alt="" width="100px" />
	<?php } else {?>
		<td><strong>Không có hình ảnh</strong></td>
	<?php } ?>	
	</td>
	<td><a href="javascript:void(0)" onclick="return getTT(<?php echo $is_slide ?>,<?php echo $news_id ?>)"><img src="/templates/shareit/images/<?php if($is_slide==0){echo 'agree.png';} else { echo 'deagree.png'; } ?>" alt="" width="40px" height="40px" /></a></td>
	<td>
	<?php 
		// Khi dang nhap tai khoan la Admindemo thi day la tk demo nen khong duoc thuc hien cac chuc nang
		if($_SESSION['userInfo']['username']!="admindemo"){ 
	?>
		<a href="edit.php?id=<?php echo $news_id;?>"><img src="/templates/shareit/images/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
		<a href="del.php?id=<?php echo $news_id;?>"><img src="/templates/shareit/images/del.gif" alt="" /> Xóa</a>
	<?php } ?>
	</td>
</tr>

<?php } ?>