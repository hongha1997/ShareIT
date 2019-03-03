<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Add Slides | Share IT';
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
                                <h4 class="title">Thêm Slide</h4>
                            </div>
                            <div class="content">
								<?php
									if(isset($_POST['submit'])){
										$fileName = $_FILES['hinhanh']['name'];	
										if($fileName != ''){
											$arFileName = explode('.', $fileName);
											$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
											$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
											$tmp_name = $_FILES['hinhanh']['tmp_name'];
											$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$fileName;
											move_uploaded_file($tmp_name, $pathUpload);
										} 
										$query = "INSERT INTO slide(anh_slide) VALUES('{$fileName}') ";
										$result = $mysqli->query($query);
										if($result){
											header('location:index.php?msg=Thêm thành công!');
											die();
										} else {
											header('location:index.php?msg=Có lỗi trong quá trình thêm');
											die();
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