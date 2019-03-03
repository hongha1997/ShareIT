<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Add User | Share IT';
</script>
    <div class="main-panel">
		<nav class="navbar navbar-default">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/rightbar.php'; ?>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Thêm Người dùng</h4>
                            </div>
                            <div class="content">
								<?php
									if(isset($_POST['submit'])){
										$username = $_POST['username'];
										$password = md5($_POST['password']);
										$hoten = $_POST['hoten'];
										$chucvu = $_POST['chucvu'];
										
										$query = "SELECT COUNT(username) AS total FROM user WHERE username = '{$username}' ";
										$result = $mysqli->query($query);									
										$ar = mysqli_fetch_assoc($result);
										if($ar['total'] == 0){
											$fileName = $_FILES['hinhanh']['name'];	
											if($fileName != ''){
												$arFileName = explode('.', $fileName);
												$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
												$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
												$tmp_name = $_FILES['hinhanh']['tmp_name'];
												$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/avatar/'.$fileName;
												move_uploaded_file($tmp_name, $pathUpload);
											} 
											$query2 = "INSERT INTO user(username, password, fullname, avatar, type) VALUES('{$username}', '{$password}', '{$hoten}', '{$fileName}', '{$chucvu}')";
											$result2 = $mysqli->query($query2);
											if($result2){
												header("location:index.php?msg=Thêm thành công");
												return;
											} else {
												header("location:index.php?msg=Có lỗi trong quá trình xử lý");
												return;
											}
										} else {
											$msg2 = "Tên tài khoản đã tồn tại";
										}
									}
								?>
                                <form action="" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label><?php if(isset($msg2)){ echo '<h4 style="color:red" >'.$msg2.'</h4>'; } ?>
                                                <input type="text" name="username" class="form-control border-input" placeholder="Username" value="">
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control border-input" placeholder="Password" value="">
                                            </div>
                                        </div>                             
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <input type="file" name="hinhanh" class="form-control" placeholder="Chọn ảnh" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input type="text" name="hoten" class="form-control border-input" placeholder="Họ và tên" value="">
                                            </div>
                                        </div>                             
                                    </div>
									
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chức vụ</label>
												<select name="chucvu" class="form-control border-input">
                                                	<option>  -- Chọn --  </option>
                                                	<option value="1">Admin</option>
                                                	<option value="0">Nhân viên</option>
                                                </select>
                                            </div>
                                        </div>                             
                                    </div>
                                    
                                    <div class="text-center">
                                        <input type="submit" name="submit" class="btn btn-info btn-fill btn-wd" value="Thêm" />
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>