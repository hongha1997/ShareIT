<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Danh Mục | Share IT';
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
                                <h4 class="title">Danh sách Danh mục</h4>
                                <?php
									if(isset($_GET['msg'])){
								?>
								<p class="category success"><?php echo $_GET['msg']; ?></p>
								<?php } ?>
                                <a href="add.php" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID Danh mục</th>
                                    	<th>Tên Danh mục</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    
									
										<?php
											$query = "SELECT * FROM cat_list WHERE parent_id = 0";
											$result = $mysqli->query($query);
											if($result->num_rows>0){
												echo '<tbody>';
												while($ar = mysqli_fetch_assoc($result)){
													$id = $ar['cat_id'];
													$name = $ar['cat_name'];
													$parent_id = $ar['parent_id'];		
														echo '<tr>';
															echo '<td>'.$id.'</td>';
															echo '<td>'.$name;
																getSubmenu($id);
															echo '</td>';
															
															echo '<td>';
															?>
															<?php 
																// Khi dang nhap tai khoan la Admindemo thi day la tk demo nen khong duoc thuc hien cac chuc nang
																if($_SESSION['userInfo']['username']!="admindemo"){ 
															?>
																<a href="edit.php?id=<?php echo $id; ?>"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
																<a href="del.php?id=<?php echo $id; ?>"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
															<?php } ?>	
															<?php
															echo '</td>';									
															 
														echo '</tr>';		
												}
												echo '</tbody>';
												
											}
											function getSubmenu($haha) {
												global $mysqli;	
												$query2 = "SELECT * FROM cat_list WHERE parent_id = {$haha} ";
												$result2 = $mysqli->query($query2);
												if($result2->num_rows>0){
													echo '<ul>';
													while($ar2 = mysqli_fetch_assoc($result2)){
														$id2 = $ar2['cat_id'];
														$name2 = $ar2['cat_name'];
														$parent_id2 = $ar2['parent_id'];
														echo '<li>'.$name2.'   ';
														
														?>
														<?php 
															// Khi dang nhap tai khoan la Admindemo thi day la tk demo nen khong duoc thuc hien cac chuc nang
															if($_SESSION['userInfo']['username']!="admindemo"){ 
														?>
															<a href="edit2.php?id=<?php echo $id2; ?>"><img src="/templates/admin/assets/img/edit.gif" alt="" />&nbsp;||&nbsp;</a>
															<a href="del.php?id=<?php echo $id2; ?>"><img src="/templates/admin/assets/img/del.gif" alt="" /></a>
															<?php } ?>
														<?php
														echo '</li>';
														
													}		
													echo '</ul>';
												}
											}
										?>
									
                                    
 
                                </table>

								
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
