<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Add Tin | Share IT';
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
                                <h4 class="title">Thêm tin</h4>
                            </div>
                            <div class="content">
								<?php
									$thongbao = "";
									if(isset($_POST['submit'])){
										$tentin = $_POST['tentin'];
										$cat_id = $_POST['cat_id'];
										$mota = $_POST['mota'];
										$chitiet = $_POST['chitiet'];
										
										if($chitiet == '' || $mota == '' ){
											$thongbao = '<strong style="color:green">Vui lòng nhập</stong>';
										} else {
										
										$illegal = "#$%^&*()+=-[]';,./{}|:<>?~";
										if(false === strpbrk($storyName, $illegal)){
											$fileName = $_FILES['hinhanh']['name'];	
											if($fileName != ''){
												$arFileName = explode('.', $fileName);
												$duoiFile = end($arFileName); // phần tử cuối cùng của mảng
												$fileName = 'VNE-Story-' . time() . '.' . $duoiFile;
												$tmp_name = $_FILES['hinhanh']['tmp_name'];
												$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileName;
												move_uploaded_file($tmp_name, $pathUpload);
											} 
											$queryAddStory = "INSERT INTO news(news_name, news_preview, news_detail, picture, cat_id) 
															VALUES('{$tentin}', '{$mota}', '{$chitiet}', '{$fileName}', {$cat_id} ) ";
											$resultAddStory = $mysqli->query($queryAddStory);
											if($resultAddStory){
												header('location:index.php?msg=Thêm thành công!');
												die();
											} else {
												header('location:index.php?msg=Có lỗi trong quá trình thêm');
												die();
											}
										}else{
											$msg2 = "Tên tin không được chứa kí tự đặc biệt";
										}
										}
									}
								?>
                                <form action="" enctype="multipart/form-data" method="post" class="frmAdd">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên tin</label>
                                                <input type="text" name="tentin" class="form-control border-input" placeholder="Tên tin" value="">
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select name="cat_id" class="form-control border-input">
                                                	<option>  -- Chọn --  </option>
													<?php 
														$queryCat = "SELECT * FROM cat_list ORDER BY cat_id DESC";
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
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả  </label><?php echo $thongbao; ?>
                                                <textarea name="mota" rows="4" class="form-control border-input ckeditor" placeholder="Mô tả tóm tắt về bạn của bạn"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chi tiết  </label><?php echo $thongbao; ?>
                                                <textarea id="editor1" name="chitiet" rows="6" class="form-control border-input" placeholder="Mô tả chi tiết về bạn của bạn"></textarea>
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
                                        <input type="submit" name="submit" class="btn btn-info btn-fill btn-wd" value="Thêm" />
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
								
							<script type="text/javascript">
									$(document).ready(function () {
										$('.frmAdd').validate({
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