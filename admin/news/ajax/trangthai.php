<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; ?>
<?php	
	$trangThai = $_POST['aTrangthai'];
	$id = $_POST['aId'];
	if($trangThai==0){
		$trangThai =1;
	} else {
		$trangThai =0;		
	}	
	$query ="UPDATE news SET is_slide = {$trangThai} WHERE news_id = {$id}";
	$result = $mysqli->query($query);
?>
<div class="content table-responsive table-full-width">
	
	<table class="table table-striped">
		<thead>
			<th>ID Tin</th>
			<th>Tên tin</th>
			<th>Danh mục</th>
			<th>Hình ảnh</th>
			<th>Trạng thái
				<?php
					$soLuong = "";
					$queryGiam = "SELECT COUNT(*) AS tatol FROM news WHERE is_slide = 1";
					$resultGiam = $mysqli->query($queryGiam);
					$arGiam = mysqli_fetch_assoc($resultGiam);
					$soLuong = $arGiam['tatol'];
					if($soLuong!=0){
						echo '<span><img src="/templates/admin/assets/img/images.png" width="20px" height="20px" />'.$soLuong.'</span>';
					}
				?>
			</th>
			<th>Chức năng</th>
		</thead>
		<tbody>
		
			<?php
				
				$query = "SELECT * FROM news as n INNER JOIN cat_list as c ON n.cat_id = c.cat_id ORDER BY news_id DESC";
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
					if($picture !=''){ // empty() 
				?>
				<td><img src="/files/<?php echo $picture ?>" alt="" width="100px" />
				<?php } else {?>
					<td><strong>Không có hình ảnh</strong></td>
				<?php } ?>	
				</td>
				<td><a href="javascript:void(0)" onclick="return getTT(<?php echo $is_slide ?>,<?php echo $news_id ?>)"><img src="/templates/shareit/images/<?php if($is_slide==0){echo 'agree.png';} else { echo 'deagree.png'; } ?>" alt="" width="40px" height="40px" /></a></td>
				
				<td>
					<a href="edit.php?id=<?php echo $news_id;?>"><img src="/templates/shareit/images/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
					<a href="del.php?id=<?php echo $news_id;?>"><img src="/templates/shareit/images/del.gif" alt="" /> Xóa</a>
				</td>
			</tr>
				<?php } ?>										
		</tbody>

	</table>
	
	<script type="text/javascript">
		function getTT(Isslide, id){
			var Trangthai = Isslide;
			var Id = id;
			$.ajax({
				url: 'ajax/trangthai.php',
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
	
</div>