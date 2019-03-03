<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Edit | Share IT';
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
                                <h4 class="title">Sửa Người dùng</h4>
                            </div>
                            <div class="content">
								<?php
									$id = 0;
									if(isset($_GET['id'])){
										$id = $_GET['id'];
										$query = "SELECT avatar FROM user WHERE user_id = {$id}";
										$result = $mysqli->query($query);
										$ar = mysqli_fetch_assoc($result);
										$fileNameOld = $ar['avatar'];

										if(isset($_POST['delete']) && $_POST['delete']==1 ){
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/avatar/'.$fileNameOld;
											unlink($filePath);
										}
									}
									
									$query2 = "SELECT * FROM user WHERE user_id = {$id} ";
									$result2 = $mysqli->query($query2);
									$ar2 = mysqli_fetch_assoc($result2);	
									$username = $ar2['username'];
									$password = $ar2['password'];
									$avatar = $ar2['avatar'];
									$fullname = $ar2['fullname'];
									$chucvu = $ar2['type'];
									if($chucvu==1){
										$chucvu2 = "Admin";
									} else if ($chucvu==0) {
										$chucvu2 = "Nhân viên";
									}
									if(isset($_POST['submit'])){
										$username = $_POST['username'];
										$password = $_POST['password'];
										$hoten = $_POST['hoten'];
										$chucvu = $_POST['chucvu'];
										$fileName = $_FILES['hinhanh']['name'];										
										if($fileName != ''){
											
											
											
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/avatar/'.$fileNameOld;
											unlink($filePath); // truyền vào đường dẫn file đang cần xóa
											
											
											
											$arFileName = explode('.', $fileName);
											$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
											$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
											$tmp_name = $_FILES['hinhanh']['tmp_name'];
											$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/avatar/'.$fileName;
											move_uploaded_file($tmp_name, $pathUpload);
										} 
										if($password == '' ){
											$query3 = "UPDATE user SET fullname = '{$hoten}',avatar = '{$fileName}',type = '{$chucvu}'  WHERE user_id = {$id} ";
											$ketqua3 = $mysqli->query($query3);  // đúng là TRUE, sai là FALSE
											if($ketqua3){ // == true
												// Thêm thành công
												header("location:index.php?msg=Sửa thành công");
												return; // có thể bỏ
												// die();
											} else {
												// Thất bại
												header("location:add.php?msg=Có lỗi trong quá trình xử lý");
												// echo "có lỗi";
												return;
												// die();
											}
										} else {
											$password = md5($password);
											$query3 = "UPDATE user SET password = '{$password}', fullname = '{$hoten}',avatar = '{$fileName}',type = '{$chucvu}'  WHERE user_id = {$id} ";
											$ketqua3 = $mysqli->query($query3);  // đúng là TRUE, sai là FALSE
											if($ketqua3){ // == true
												// Thêm thành công
												header("location:index.php?msg=Sửa thành công");
												return; // có thể bỏ
												// die();
											} else {
												// Thất bại
												header("location:add.php?msg=Có lỗi trong quá trình xử lý");
												// echo "có lỗi";
												return;
												// die();
											}
										}
									}
								?>
                                <form action="" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label><?php if(isset($msg2)){ echo '<h4 style="color:red" >'.$msg2.'</h4>'; } ?>
                                                <input type="text" name="username" class="form-control border-input"  readonly placeholder="Username" value="<?php echo $username; ?>">
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
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh cũ</label>
												<?php if($avatar!=''){ ?>
                                                <img src="/files/avatar/<?php echo $avatar; ?>" width="120px" alt="" /> Xóa hình <input type="checkbox" name="delete" value="1" />
												<?php	 }else { echo 'Không có ảnh';}?>
											</div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input type="text" name="hoten" class="form-control border-input" placeholder="Họ và tên" value="<?php echo $fullname; ?>">
                                            </div>
                                        </div>                             
                                    </div>
									
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chức vụ</label>
												<select name="chucvu" class="form-control border-input">
                                                	<option value="<?php echo $chucvu; ?>"><?php echo $chucvu2; ?></option>
													<?php 
														$querytt = "SELECT * FROM user WHERE type != {$chucvu} LIMIT 1";
														$resulttt = $mysqli->query($querytt);
														while($artt = mysqli_fetch_assoc($resulttt)){
															$type = $artt['type'];
															if($type==1){
																$type2 = "Admin";
															} else if($type==0){
																$type2 = "Nhân viên";
															}
															
													?>
                                                	<option value="<?php echo $type; ?>"><?php echo $type2; ?></option>
													<?php } ?>
                                                </select>
                                            </div>
                                        </div>                             
                                    </div>
                                    
                                    <div class="text-center">
                                        <input type="submit" name="submit" class="btn btn-info btn-fill btn-wd" value="Sửa" />
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
