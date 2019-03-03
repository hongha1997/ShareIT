<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Search Comment | Share IT';
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
									<?php 
										$name=''; 
										if(isset($_POST['search'])){	
											$name = $_POST['name'];			
										}			
										$query2 = "SELECT COUNT(*) AS total FROM comment AS c INNER JOIN news AS n ON n.news_id = c.id_news WHERE news_name LIKE '%{$name}%'" ;
										$result2 = $mysqli->query($query2);
										$ar2 = mysqli_fetch_assoc($result2);
										$total2 = $ar2['total'];
										echo 'Bạn đang tìm kiếm <strong style="color:blue">'.$name.'</strong> với '.$total2.' kết quả tìm kiếm.'; 
									?>
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
											$query = "SELECT * FROM comment AS c INNER JOIN news AS n ON n.news_id = c.id_news WHERE n.news_name LIKE '%{$name}%'";
											$result = $mysqli->query($query);
											$i=0;
											while($arNews = mysqli_fetch_assoc($result)){
												$id_comment = $arNews['id_comment'];
												$news_name = $arNews['news_name'];
												$email = $arNews['email'];
												$name = $arNews['name'];
												$noidung = $arNews['noidung'];
												$like = $arNews['likeCm'];
												$trangthai = $arNews['trangthai'];
												$id_news = $arNews['id_news'];
												$i++;
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
                                        		<a href="del.php"><img src="/templates/shareit/images/del.gif" alt="" /> Xóa</a>
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
								    <ul class="pagination">
								        <li><a href="?p=0" title="">1</a></li> 
								        <li><a href="?p=1" title="">2</a></li> 
								        <li><a href="?p=1" title="">3</a></li> 
								        <li><a href="?p=1" title="">4</a></li> 
								    </ul>
								</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>