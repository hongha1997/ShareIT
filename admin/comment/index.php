<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php 
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM comment";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	// số truyện trên 1 trang
	$row_count = ROW_COUNT;
	// tổng số trang
	$tongSoTrang = ceil($tongSoDong/$row_count);
	// trang hiện tại
	$current_page = 1;
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	// offset
	$offset = ($current_page - 1) * $row_count;
?>
<script type="text/javascript">
	document.title='Comment | Share IT';
</script>
    <div class="main-panel">
		<nav class="navbar navbar-default">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/rightbar.php'; ?>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh sách Comments</h4>
								<?php
									if(isset($_GET['msg'])){
								?>
								<p class="category success"><?php echo $_GET['msg']; ?></p>
								<?php } ?>
                                <form action="/admin/comment/search.php" method="post">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control border-input" placeholder="Tên Tin tức" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        	<div class="form-group">
		                                        <input type="submit" name="search" value="Tìm kiếm" class="is" />
	                                        </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="content table-responsive table-full-width">
								<div id="ket-qua">
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
											$query = "SELECT * FROM comment AS c INNER JOIN news AS n ON n.news_id = c.id_news ORDER BY id_comment DESC LIMIT {$offset}, {$row_count}";
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
								</div>
								<div class="text-center">
								<ul class="pagination pagination-lg">
									<?php
										if($current_page>1){
									?>
									<li><a href="index.php?page=<?php echo $current_page-1; ?>"><i class="fa fa-angle-left">«</i></a></li>
										<?php } ?>
									<?php
										for($i=1; $i <= $tongSoTrang; $i++){
									?>
									<?php
										if($i == $current_page){
											
									?>
										<li class="active"><a href=""><?php echo $current_page; ?></a></li>
										
										<?php } else { ?>
										<li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
										<?php } ?>
										<?php } ?>
									<?php
										if($current_page<$tongSoTrang){
									?>
									<li><a href="index.php?page=<?php echo $current_page+1; ?>"><i class="fa fa-angle-right">»</i></a></li>
									<?php } ?>
								</ul>

								</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>