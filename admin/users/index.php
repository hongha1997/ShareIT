<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='User | Share IT';
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(".timkiem").keyup(function(){
        var txt = $(".timkiem").val();
		$.post('ajax.php',{data:txt}, function(data){
			$('.danhsach').html(data);
		})
    });
});
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
                                <h4 class="title">Danh sách Người dùng</h4>
                                <?php
									if(isset($_GET['msg'])){
								?>
								<p class="category success"><?php echo $_GET['msg']; ?></p>
								<?php } ?>
                                <form action="" method="post">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="timkiem form-control border-input" placeholder="Tên Người dùng " value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                                
                                <a href="add.php" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID Người dùng</th>
                                    	<th>Username</th>
										<th>Fullname</th>
                                    	<th>Chức vụ</th>
                                    	<th>Avatar</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    <tbody class="danhsach">
										
										<?php
											
											$query = "SELECT * FROM user ORDER BY user_id DESC";
											$result = $mysqli->query($query);
											while($arNews = mysqli_fetch_assoc($result)){
												$user_id = $arNews['user_id'];
												$username = $arNews['username'];
												$password = $arNews['password'];
												$fullname = $arNews['fullname'];
												$avatar = $arNews['avatar'];	
												$active = $arNews['active'];	
												$type = $arNews['type'];	
										?>
									
                                        <tr>
                                        	<td><?php echo $user_id; ?></td>
                                        	<td><?php echo $username; ?></td>
                                        	<td><?php echo $fullname; ?></td>
											<?php 
												if($type==1){
													$chucvu = "Admin";
												} else {
													$chucvu = "Nhân viên";
												}
											?>
                                        	<td><?php echo $chucvu; ?></td>
											<?php 
												if($avatar !=''){ // empty() 
											?>
                                        	<td><img src="/files/avatar/<?php echo $avatar ?>" alt="" width="80px" height="80px" /></td>
                                        	<?php } else {?>
												<td><strong>Không có hình ảnh</strong></td>
											<?php } ?>
											
											<td>
											<?php 
												// Khi dang nhap tai khoan la Admindemo thi day la tk demo nen khong duoc thuc hien cac chuc nang
												if($_SESSION['userInfo']['username']!="admindemo"){ 
											?>
                                        		<?php if($_SESSION['userInfo']['username']==$username  || $_SESSION['userInfo']['username'] == 'admin'){ ?>
												<a href="edit.php?id=<?php echo $user_id ?>"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                        		<?php }?>
												
												<?php if(($_SESSION['userInfo']['username']==$username && $username != 'admin') || ($_SESSION['userInfo']['username'] == 'admin' && $username != 'admin')){ ?>
												<a href="del.php?id=<?php echo $user_id ?>"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
												<?php } ?>
											<?php } ?>
											</td>
											
                                        </tr> 
										
											<?php } ?>
										
                                    </tbody>
 
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>