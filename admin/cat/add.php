<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Add Danh Mục | Share IT';
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
                                <h4 class="title">Thêm Danh mục</h4>
                            </div>
                            <div class="content">
								<?php
									if(isset($_POST['submit'])){
										$namedm = $_POST['namedm'];
										$list_dm = $_POST['list_dm'];
										if($list_dm==0){
											$queryAdd = "INSERT INTO cat_list(cat_name) VALUES('{$namedm}')";
											$resultAdd = $mysqli->query($queryAdd);
											if($resultAdd){
												header("location:index.php?msg=Thêm thành công");
												return;
											} else {
												header("location:add.php?msg=Có lỗi trong quá trình xử lý");
												return;
											}
										} else {
											$queryAdd = "INSERT INTO cat_list(cat_name, parent_id) VALUES('{$namedm}','{$list_dm}')";
											$resultAdd = $mysqli->query($queryAdd);
											if($resultAdd){
												header("location:index.php?msg=Thêm thành công");
												return;
											} else {
												header("location:add.php?msg=Có lỗi trong quá trình xử lý");
												return;
											}
										}
										die();
									}
								?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên Danh mục</label>
                                                <input type="text" name="namedm" class="form-control border-input" placeholder="Tên danh mục" value="" required>
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Danh mục cha</label>
                                                <select name="list_dm" class="form-control border-input">
                                                	<option value="0">Không</option>
													<?php 
														$queryCat = "SELECT * FROM cat_list WHERE parent_id = 0";
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
