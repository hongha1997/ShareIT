<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Slides | Share IT';
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
                                <h4 class="title">Danh sách Slide</h4>
                                <?php
									if(isset($_GET['msg'])){
								?>
								<p class="category success"><?php echo $_GET['msg']; ?></p>
								<?php } ?>	
                                <a href="add.php" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                            </div>
                            <div class="content table-responsive table-full-width">
								<div id="ket-qua">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Ảnh</th>
                                    	<th>Trạng thái
											<?php
												$soLuong = "";
												$queryGiam = "SELECT COUNT(*) AS tatol FROM slide WHERE trangthai_slide = 1";
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
											$query = "SELECT * FROM slide ORDER BY id_slide DESC";
											$result = $mysqli->query($query);
											while($ar = mysqli_fetch_assoc($result)){
												$id_slide = $ar['id_slide'];
												$anh_slide = $ar['anh_slide'];
												$trangthai_slide = $ar['trangthai_slide'];
										?>
									
                                        <tr>
                                        	<td><?php echo $id_slide; ?></td>
                                        	<?php 
												if($anh_slide !=''){ // empty() 
											?>
                                        	<td><img src="/files/slide/<?php echo $anh_slide ?>" alt="" width="100px" />
											<?php } else {?>
												<td><strong>Không có hình ảnh</strong></td>
											<?php } ?>
                                        	<td><a href="javascript:void(0)" onclick="return getTT3(<?php echo $trangthai_slide ?>,<?php echo $id_slide ?>)"><img src="/templates/shareit/images/<?php if($trangthai_slide==0){echo 'agree.png';} else { echo 'deagree.png'; } ?>" alt="" width="40px" height="40px" /></a></td>
											<td>
                                        		<a href="edit.php?id=<?php echo $id_slide ?>"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                        		<a href="del.php?id=<?php echo $id_slide ?>"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
                                        	</td>
                                        </tr>
										
											<?php } ?>
										
                                    </tbody>
 
                                </table>
								<script type="text/javascript">
									function getTT3(trangthai, id){
										var Trangthai = trangthai;
										var Id = id;
										$.ajax({
											url: 'ajax/trangthai3.php',
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