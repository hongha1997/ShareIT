<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Search Liên Hệ | Share IT';
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
									<?php 
										$name=''; 
										if(isset($_POST['submit'])){	
											$name = $_POST['name'];			
										}
										$query2 = "SELECT COUNT(*) AS total FROM contact WHERE name_contact LIKE '%{$name}%'" ;
										$result2 = $mysqli->query($query2);
										$ar2 = mysqli_fetch_assoc($result2);
										$total2 = $ar2['total'];
										echo 'Bạn đang tìm kiếm <strong style="color:blue">'.$name.'</strong> với '.$total2.' kết quả tìm kiếm.'; 
									?>
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
											
											$query = "SELECT * FROM contact WHERE name_contact LIKE '%{$name}%' ";
											$result = $mysqli->query($query);
											$i=0;
											while($ar = mysqli_fetch_assoc($result)){
												$id_contact = $ar['id_contact'];
												$name_contact = $ar['name_contact'];
												$email_contact = $ar['email_contact'];
												$sdt_contact = $ar['sdt_contact'];
												$contact = $ar['contact'];	
												$i++;
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
										<?php
											if($i==0){
												echo '<h3 style="color:red">Không có tin cần tìm!</h3>';
											} 
										?>
                                    </tbody>
 
                                </table>

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