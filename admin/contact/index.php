<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php 
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM contact";
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
	document.title='Liên Hệ | Share IT';
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
                                <h4 class="title">Danh sách Liên hệ</h4>
                                <form action="/admin/contact/search.php" method="post">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control border-input" placeholder="Tên liên hệ" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        	<div class="form-group">
		                                        <input type="submit" name="submit" value="Tìm kiếm" class="is" />
	                                        </div>
                                        </div>
                                    </div>        
                                </form>
							</div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Tên</th>
										<th>Email</th>
                                    	<th>Số ĐT</th>
                                    	<th>Nội dung</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    <tbody>
										<?php
											$queryCT = "SELECT * FROM contact ORDER BY id_contact DESC LIMIT {$offset}, {$row_count}";
											$resultCT = $mysqli->query($queryCT);
											while($arCT = mysqli_fetch_assoc($resultCT)){
												$id_contact = $arCT['id_contact'];
												$name_contact = $arCT['name_contact'];
												$email_contact = $arCT['email_contact'];
												$sdt_contact = $arCT['sdt_contact'];
												$contact = $arCT['contact'];
										?>
                                        <tr>
                                        	<td><?php echo $id_contact; ?></td>
                                        	<td><?php echo $name_contact; ?></td>
                                        	<td><?php echo $email_contact; ?></td>
                                        	<td><?php echo $sdt_contact; ?></td>
                                        	<td><?php echo $contact; ?></td>
											<td>
                                        		<a href="del.php?id=<?php echo $id_contact; ?>"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
                                        	</td>
                                        </tr>
										<?php } ?>
                                    </tbody>
 
                                </table>

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