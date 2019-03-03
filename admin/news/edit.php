<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Edit Tin | Share IT';
</script>
<style>
	#tentin-error {
		color:red;
	}
	#mota-error {
		color:red;
	}
	#chitiet-error {
		color:red;
	}
</style>
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
                                <h4 class="title">Sửa tin</h4>
                            </div>
                            <div class="content">
								<?php
									
									$id = 0;
									if(isset($_GET['id'])){
										$id = $_GET['id'];

										
										
										
										$queryNews = "SELECT picture FROM news WHERE news_id = {$id}";
										$resultNews = $mysqli->query($queryNews);
										$arNews = mysqli_fetch_assoc($resultNews);
										$fileNameOld = $arNews['picture'];

										if(isset($_POST['delete']) && $_POST['delete']==1 ){
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileNameOld;
											unlink($filePath);
										}
									}
									$query = "SELECT * FROM news AS n INNER JOIN cat_list AS c ON c.cat_id = n.cat_id WHERE n.news_id = {$id} ";
									$result = $mysqli->query($query);
									$ar = mysqli_fetch_assoc($result);				
									$news_id = $ar['news_id'];
									$news_name = $ar['news_name'];
									$news_preview = $ar['news_preview'];
									$news_detail = $ar['news_detail'];
									$date_create = $ar['date_create'];	
									$created_by = $ar['created_by'];	
									$picture = $ar['picture'];	
									$cat_id = $ar['cat_id'];	
									$is_slide = $ar['is_slide'];
									$cat_name = $ar['cat_name'];
									//echo $news_preview;
									//echo $news_detail;
									//echo $date_create;
									//die();
									if(isset($_POST['submit'])){
										$tentin = $_POST['tentin'];
										$cat_id = $_POST['cat_id'];
										$mota = $_POST['mota'];
										$chitiet = $_POST['chitiet'];
										

											
										$fileName = $_FILES['hinhanh']['name'];										
										if($fileName != ''){
											
											
											
											$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileNameOld;
											unlink($filePath); // truyền vào đường dẫn file đang cần xóa
											
											
											
											$arFileName = explode('.', $fileName);
											$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
											$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
											$tmp_name = $_FILES['hinhanh']['tmp_name'];
											$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileName;
											move_uploaded_file($tmp_name, $pathUpload);
										} 										
										$queryEditS = "UPDATE news SET news_name = '{$tentin}', news_preview = '{$mota}' , news_detail = '{$chitiet}' , picture = '{$fileName}' , cat_id = '{$cat_id}' WHERE news_id = {$id} ";
										$resultEditS = $mysqli->query($queryEditS);  // đúng là TRUE, sai là FALSE
										if($resultEditS){ // == true
											// Thêm thành công
											header("location:index.php?msg=Sửa thành công");
											return; // có thể bỏ
										} else {
											// Thất bại
											header("location:index.php?msg=Có lỗi trong quá trình xử lý");
											return;
										}
										
									}
								?>
                                <form enctype="multipart/form-data" action="" method="post" class="frmEdit">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" name="id" class="form-control border-input" disabled value="<?php echo $news_id; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên tin</label>
                                                <input type="text" name="tentin" class="form-control border-input" placeholder="Tên tin" value="<?php echo $news_name ?>">
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Danh mục tin</label>
                                                <select name="cat_id" class="form-control border-input">
                                                	<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
											
                                                	<?php 
														$queryCat = "SELECT * FROM cat_list WHERE cat_id != {$cat_id} ORDER BY cat_id DESC";
														$resultCat = $mysqli->query($queryCat);
														while($arCat = mysqli_fetch_assoc($resultCat)){
															$catId = $arCat['cat_id'];
															$nameCat = $arCat['cat_name'];
													?>
                                                	<option value="<?php echo $catId ?>"><?php echo $nameCat ?></option>
													<?php } ?>
                                                </select>
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
												<?php if($picture!=''){ ?>
                                                <img src="/files/<?php echo $picture; ?>" width="120px" alt="" /> Xóa hình <input type="checkbox" name="delete" value="1" />
												<?php }else { echo 'Không có ảnh';}?>
											</div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea rows="4" name="mota" class="form-control border-input ckeditor" placeholder="Mô tả "><?php echo $news_preview; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chi tiết</label>
                                                <textarea id="editor1" rows="6" name="chitiet" class="form-control border-input" placeholder="Chi tiết"><?php echo $news_detail; ?></textarea>
												<script type="text/javascript">
													 CKEDITOR.replace( 'editor1',
													 {
														 filebrowserBrowseUrl: '/library/ckfinder/ckfinder.html',
														 filebrowserImageBrowseUrl: '/library/ckfinder/ckfinder.html?type=Images',
														 filebrowserUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
														 filebrowserImageUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
													 });
												</script>
											</div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <input type="submit" name="submit" class="btn btn-info btn-fill btn-wd" value="Sửa" />
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
								
								<script type="text/javascript">
									$(document).ready(function () {
										$('.frmEdit').validate({
											rules: {
												tentin: {
													required: true,
												},												
												cat_id: {
													required: true,
												},
												mota: {
													required: true,
												},
												chitiet: {
													required: true,
												}
											},
											messages: {
												tentin: {
													required:"Vui lòng nhập tên tin",
												},												
												cat_id: {
													required:"Vui lòng nhập danh mục",
												},
												mota: {
													required:"Vui lòng nhập mô tả",
												},
												chitiet: {
													required:"Vui lòng nhập chi tiết",
												}
											}
										});
									});
								</script>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
