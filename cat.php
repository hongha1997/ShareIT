<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="/">Trang chủ</a></li>
				<?php
					$id_cat = 0;
					if(isset($_GET['id'])){
						$id_cat = $_GET['id'];
					}
					$query2 = "SELECT * FROM cat_list WHERE cat_id = {$id_cat}";
					$result2 = $mysqli->query($query2);
					$arNews2 = mysqli_fetch_assoc($result2);
					$name = $arNews2['cat_name'];
					$name_seo2 = utf8ToLatin($name);
					$id = $arNews2['cat_id'];
					
					$url2 = "/".$name_seo2."-".$id;
					
					
					// tổng số dòng
					$queryTSD = "SELECT COUNT(*) AS TSD FROM news WHERE cat_id = {$id_cat} ";
					$resultTSD = $mysqli->query($queryTSD);
					$arTmp = mysqli_fetch_assoc($resultTSD);
					$tongSoDong = $arTmp['TSD'];
					// số truyện trên 1 trang
					$row_count = ROW_COUNT;
					// tổng số trang
					$tongSoTrang = ceil($tongSoDong/$row_count);
					// trang hiện tại
					$current_page = 1;
					if(isset($_GET['page'])){
						$current_page = $_GET['page'];
					}
					// offset
					$offset = ($current_page - 1) * $row_count;
					
				?>
				<li class="active">Danh mục / <?php echo $name; ?></li>
			</ol>
			<script type="text/javascript">
				document.title='<?php echo $name; ?> | Share IT';
			</script>
		</div>
	</div>
	<!-- //main-slider -->
	<!-- //top-header and slider -->
	<div class="container">
		<div class="banner-btm-agile">
		<!-- //btm-wthree-left -->
		
			<div class="col-md-9 btm-wthree-left">
				<?php
					
					$query = "SELECT * FROM news WHERE cat_id = {$id_cat} ORDER BY news_id DESC LIMIT {$offset}, {$row_count}";
					$result = $mysqli->query($query);
					while($arNews = mysqli_fetch_assoc($result)){
						$news_id = $arNews['news_id'];
						$news_name = $arNews['news_name'];
						
						$name_seo =utf8ToLatin($news_name);
						
						$news_preview = $arNews['news_preview'];
						$news_detail = $arNews['news_detail'];
						$date_create = $arNews['date_create'];
						$date_create = date("j / n / Y");						
						$created_by = $arNews['created_by'];	
						$picture = $arNews['picture'];	
						$cat_id = $arNews['cat_id'];	
						$is_slide = $arNews['is_slide'];	
						
						$url ="/".$name_seo."-".$news_id.".html";
				?>
				
				
				
				<hr/>
				<div class="wthree-top">
					<div class="w3agile-top">
						<div class="w3agile_special_deals_grid_left_grid">
							<a href="<?php echo $url; ?>"><img src="/files/<?php echo $picture ?>" class="img-responsive" alt="" /></a>
						</div>
						<div class="w3agile-middle">
						<ul>
							<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date_create ?></li>
							<li><i class="fa fa-eye" aria-hidden="true"></i><?php echo $created_by; ?></li>
							<?php
								$query5 = "SELECT COUNT(*) AS tong FROM comment WHERE id_news = {$news_id}";
								$result5 = $mysqli->query($query5);
								$ar5 = mysqli_fetch_assoc($result5);
								$tong = $ar5['tong'];
							?>
							<li><i class="fa fa-comment" aria-hidden="true"></i><?php echo $tong; ?> COMMENTS</li>
							
						</ul>
					</div>
					</div>
					
					<div class="w3agile-bottom">
						<div class="col-md-3 w3agile-left">
							<h5>Thông tin:</h5>
						</div>
						<div class="col-md-9 w3agile-right">
							<h3><a href="<?php echo $url; ?>"><?php echo $news_name; ?></a></h3>
							<p><?php echo $news_preview; ?></p>
							<a class="agileits w3layouts" href="<?php echo $url; ?>">Chi tiết<span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
					<?php } ?>
				
				<ul class="pagination pagination-lg">
					<?php
						if($current_page>1){
					?>
					<?php 
						$tam1 = $current_page-1;
						
						$url4 = $url2.'-page'.$tam1; 
						
					?>
					<li><a href="<?php echo $url4; ?>"><i class="fa fa-angle-left">«</i></a></li>
						<?php } ?>
					<?php
						for($i=1; $i <= $tongSoTrang; $i++){
							$url3 = $url2.'-page'.$i;
					?>
					<?php
						if($i == $current_page){
							
					?>
						<li class="active"><a href=""><?php echo $current_page; ?></a></li>
						
						<?php } else { ?>
						<li><a href="<?php echo $url3; ?>"><?php echo $i; ?></a></li>
						<?php } ?>
						<?php } ?>
					<?php
						if($current_page < $tongSoTrang){
							$tam2 = $current_page+1;
							$url5 = $url2.'-page'.$tam2; 
					?>
					<li><a href="<?php echo $url5; ?>"><i class="fa fa-angle-right">»</i></a></li>
					<?php } ?>
				</ul>
			</div>
			<!-- //btm-wthree-left -->
			<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>