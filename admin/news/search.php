<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Search Tin | Share IT';
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
                                
                                <form action="/admin/news/search.php" method="post">
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
                                
                                <a href="add.php" class="addtop"><img src="/templates/shareit/images/add.png" alt="" /> Thêm</a>
                            </div>
							<div id="ket-qua">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
									<?php 
										$name=''; 
										if(isset($_POST['search'])){	
											$name = $_POST['name'];			
										}
										$query2 = "SELECT COUNT(*) AS total FROM news WHERE news_name LIKE '%{$name}%'" ;
										$result2 = $mysqli->query($query2);
										$ar2 = mysqli_fetch_assoc($result2);
										$total2 = $ar2['total'];
										echo 'Bạn đang tìm kiếm <strong style="color:blue">'.$name.'</strong> với '.$total2.' kết quả tìm kiếm.'; 
									?>
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
											$query = "SELECT * FROM news as n INNER JOIN cat_list as c ON n.cat_id = c.cat_id WHERE n.news_name LIKE '%{$name}%'";
											$result = $mysqli->query($query);
											$i=0;
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
												$i++;
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
										<?php
											if($i==0){
												echo '<h3 style="color:red">Không có tin cần tìm!</h3>';
											} 
										?>
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
                        </div>
                    </div>


                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>