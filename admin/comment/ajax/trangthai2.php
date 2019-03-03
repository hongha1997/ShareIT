
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; ?>
<?php	
	$trangThai = $_POST['aTrangthai'];
	$id = $_POST['aId'];
	if($trangThai==0){
		$trangThai =1;
	} else {
		$trangThai =0;		
	}	
	$query ="UPDATE comment SET trangthai = {$trangThai} WHERE id_comment = {$id}";
	$result = $mysqli->query($query);
?>
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Tên tin</th>
		<th>Tên</th>
		<th>Email</th>
		<th>Nội dung</th>
		<th>Like</th>
		<th>Chức năng
			<?php
				$soLuong = "";
				$queryGiam = "SELECT COUNT(*) AS tatol FROM comment WHERE trangthai = 1";
				$resultGiam = $mysqli->query($queryGiam);
				$arGiam = mysqli_fetch_assoc($resultGiam);
				$soLuong = $arGiam['tatol'];
				if($soLuong!=0){
					echo '<span><img src="/templates/admin/assets/img/images.png" width="20px" height="20px" />'.$soLuong.'</span>';
				}
			?>
		</th>
	</thead>
	<tbody>
	
		<?php
			$query = "SELECT * FROM comment AS c INNER JOIN news AS n ON n.news_id = c.id_news ORDER BY id_comment DESC";
			$result = $mysqli->query($query);
			while($arNews = mysqli_fetch_assoc($result)){
				$id_comment = $arNews['id_comment'];
				$news_name = $arNews['news_name'];
				$email = $arNews['email'];
				$name = $arNews['name'];
				$noidung = $arNews['noidung'];
				$like = $arNews['likeCm'];
				$trangthai = $arNews['trangthai'];
				$id_news = $arNews['id_news'];
		?>
	
		<tr>
			<td><?php echo $id_comment; ?></td>
			<td><?php echo $news_name; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $noidung; ?></td>
			<td><?php echo $like; ?></td>
			<td>
				<a href="javascript:void(0)" onclick="return getTT2(<?php echo $trangthai; ?>,<?php echo $id_comment; ?>)"><img src="/templates/shareit/images/<?php if($trangthai==0){echo 'agree.png';} else { echo 'deagree.png'; } ?>" alt="" width="25px" height="25px" />Ẩn/Hiện</a> ||
				<a href="del.php?id=<?php echo $id_comment; ?>"><img src="/templates/shareit/images/del.gif" alt="" /> Xóa</a>
			</td>
		</tr>	

			<?php } ?>
		
	</tbody>

</table>
<script type="text/javascript">
	function getTT2(trangthai, id){
		var Trangthai = trangthai;
		var Id = id;
		$.ajax({
			url: 'ajax/trangthai2.php',
			type: 'POST',  // POST or GET
			cache: false, // true là lưa lại thông tin, false ko lưu, có thể xóa
			data: {
				aTrangthai: Trangthai,
				aId: Id
			},
			success: function(data){ // dữ liệu lấy qua biến data
				//$('.jquery-demo-ajax').html(data);
				//alert(data);
				$('#ket-qua').html(data);
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
		return false;
	}
</script>
