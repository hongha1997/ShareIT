<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
    $(".timkiem").keyup(function(){
        var txt = $(".timkiem").val();
		$.post('ajax/ajax.php',{data:txt}, function(data){
			$('.danhsach').html(data);
		})
    });
});
</script>
<?php 
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM news";
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
	document.title='Tin | Share IT';
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
                                <h4 class="title">Danh sách tin</h4>
								<?php
									if(isset($_GET['msg'])){
								?>
								<p class="category success"><?php echo $_GET['msg']; ?></p>
								<?php } ?>
                                
                                <form action="" method="post">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="timkiem form-control border-input" placeholder="Tên Tin tức" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                                <a href="add.php" class="addtop"><img src="/templates/shareit/images/add.png" alt="" /> Thêm</a>
								
                            </div>
							<div id="ket-qua">
							
							
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
												$queryGiam = "SELECT COUNT(*) AS tatol FROM news WHERE is_slide = 1 ";
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
                                    <tbody class="danhsach">
									
										<?php
											
											$query = "SELECT * FROM news as n INNER JOIN cat_list as c ON n.cat_id = c.cat_id ORDER BY news_id DESC LIMIT {$offset}, {$row_count}";
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
							</div>
							<div class="text-center">
								<ul class="pagination pagination-lg">				
								<?php 								
								$url2='index.php?page=1';
								$prev=$current_page-1;											
								$next=$current_page+1;											
								if($current_page > 1 && $tongSoTrang > 1){
								$urlp='index.php?page='.$prev; 
								?>
								<li class="" ><a href="<?php echo $urlp?>">PREV</a></li>
								<?php }?>
								<?php	
								$limit=5  ;
								if ($current_page > ($limit/2))
								?>
								<li class=" " ><a href="<?php echo $url2?>">1</a></li>
								<li><span id="sp">...</span></li>
								<?php 
								if ($tongSoTrang >=1 && $current_page <= $tongSoTrang)
								{
								$counter = 1;						
								for ($i=$current_page; $i<=$tongSoTrang;$i++){
								$url2='index.php?page='.$i;
								if($counter < $limit){
									$active='';
									if($i==$current_page){
										$active='active';
									}
								?>	
									<li class=" <?php echo $active?>" ><a href="<?php echo $url2?>"><?php echo $i?></a></li>
									<?php	
									$counter++;
									}
									}
									if ($current_page < $tongSoTrang - ($limit/2))
										?>	<li><span id="sp">...</span></li>
											<li class=" <?php //echo $active?>" ><a href="<?php echo $url2?>"><?php echo $tongSoTrang?></a></li>
										<?php
										}
										?>				
									<?php					
									if ($current_page < $tongSoTrang && $tongSoTrang > 1){
									 $urln='index.php?page='.$next;
								 ?>
								  <li class="" ><a href="<?php echo $urln?>">NEXT</a></li>					
									<?php
									}
								   ?>										
								</ul>
							</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>