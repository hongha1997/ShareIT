<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Edit Slides | Share IT';
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
                                <h4 class="title">Sửa Slide</h4>
                            </div>
                            <div class="content">
								<?php
									$id = 0;
									if(isset($_GET['id'])){
										$id = $_GET['id'];
										$query = "SELECT anh_slide FROM slide WHERE id_slide = {$id}";
										$result = $mysqli->query($query);
										$ar = mysqli_fetch_assoc($result);
										$fileNameOld = $ar['anh_slide'];

										if(isset($_POST['delete']) && $_POST['delete']==1 ){
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$fileNameOld;
											unlink($filePath);
										}
									}
									
									$query2 = "SELECT * FROM slide WHERE id_slide = {$id} ";
									$result2 = $mysqli->query($query2);
									$ar2 = mysqli_fetch_assoc($result2);	
									$anh_slide = $ar2['anh_slide'];
									
									
									if(isset($_POST['submit'])){
										$fileName = $_FILES['hinhanh']['name'];										
										if($fileName != ''){
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$fileNameOld;
											unlink($filePath); // truyền vào đường dẫn file đang cần xóa
											
											
											
											$arFileName = explode('.', $fileName);
											$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
											$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
											$tmp_name = $_FILES['hinhanh']['tmp_name'];
											$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$fileName;
											move_uploaded_file($tmp_name, $pathUpload);
										} 
										
											$query3 = "UPDATE slide SET anh_slide = '{$fileName}' WHERE id_slide = {$id} ";
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
								?>
                                <form action="" enctype="multipart/form-data" method="post">
                                    
                                    
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
												<?php if($anh_slide!=''){ ?>
                                                <img src="/files/slide/<?php echo $anh_slide; ?>" width="120px" alt="" /> Xóa hình <input type="checkbox" name="delete" value="1" />
												<?php	 }else { echo 'Không có ảnh';}?>
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
