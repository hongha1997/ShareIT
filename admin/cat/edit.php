<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Edit Danh Mục | Share IT';
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
                                <h4 class="title">Sửa Danh mục</h4>
                            </div>
                            <div class="content">
								<?php
									$id = 0;
									if(isset($_GET['id'])){
										$id = $_GET['id'];
									}
									$queryDM = "SELECT * FROM cat_list WHERE cat_id = {$id}";
									$resultDM = $mysqli->query($queryDM);
									$arDM = mysqli_fetch_assoc($resultDM);
									$nameOld = $arDM['cat_name'];
									$parent_id = $arDM['parent_id'];
									$cat_id = $arDM['cat_id'];
									$queryDM2 = "SELECT COUNT(*) AS total FROM cat_list WHERE parent_id = {$cat_id}";
									$resultDM2 = $mysqli->query($queryDM2);
									$arDM2 = mysqli_fetch_assoc($resultDM2);
									$total = $arDM2['total'];
									if(isset($_POST['submit'])){
										$name_dm = $_POST['name_dm'];
										$list_dm = $_POST['list_dm'];
										if($total==0){
											$queryEdit = "UPDATE cat_list SET cat_name = '{$name_dm}', parent_id = '{$list_dm}' WHERE cat_id = {$id} ";
											$resultEdit = $mysqli->query($queryEdit);
											if($resultEdit){
												header("location:index.php?msg=Sửa thành công");
												return; 
											} else {
												header("location:index.php?msg=Có lỗi trong quá trình xử lý");
												return;
											}
										}else {
											$queryEdit = "UPDATE cat_list SET cat_name = '{$name_dm}' WHERE cat_id = {$id} ";
											$resultEdit = $mysqli->query($queryEdit);
											if($resultEdit){
												header("location:index.php?msg=Sửa thành công");
												return; 
											} else {
												header("location:index.php?msg=Có lỗi trong quá trình xử lý");
												return;
											}
										}
									}
								?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
												
                                                <label>Tên danh mục</label>
                                                <input type="text" name="name_dm" class="form-control border-input" placeholder="Tên danh mục" value="<?php echo $nameOld; ?>" required>
                                            </div>
                                        </div>                             
                                    </div>
									<?php
										if($total==0){
									?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select name="list_dm" class="form-control border-input">
                                                	<option value="0">Không</option>
													<?php 
														$queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 AND cat_id != '{$cat_id}'";
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
										<?php } ?>
                                    
                                    
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
