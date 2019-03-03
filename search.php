<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<script type="text/javascript">
	document.title='Tìm Kiếm | Share IT';
</script>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="/">Trang chủ</a></li>
				<li class="active">Tiềm kiếm / 
				<?php 
				
					$search = '';
					if(isset($_POST['submit'])){
						$search = $_POST['search'];		
					}
					
					if($_POST['search']==""){
						header("location:product.php");
					}
					
					$query2 = "SELECT COUNT(*) AS total FROM news WHERE news_name LIKE '%{$search}%'" ;
					$result2 = $mysqli->query($query2);
					$ar2 = mysqli_fetch_assoc($result2);
					$total2 = $ar2['total'];
					echo 'Bạn đang tìm kiếm <strong style="color:blue">'.$search.'</strong> với '.$total2.' kết quả tìm kiếm.'; 
				?>
				</li>
			</ol>
		</div>
	</div>
	<!-- //main-slider -->
	<!-- //top-header and slider -->
	<div class="container">
		<div class="banner-btm-agile">
		<!-- //btm-wthree-left -->
		
			<div class="col-md-9 btm-wthree-left">
				<?php
				
					
					
					$search = '';
					if(isset($_POST['submit'])){
						$search = $_POST['search'];		
					}
					
					
					
					$query = "SELECT * FROM news WHERE news_name LIKE '%{$search}%'  ";
					$result = $mysqli->query($query);
					$i=0;
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
						
						$i++;
						
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
				<?php
					if($i==0){
						echo '<h3 style="color:red">Không có tin cần tìm!</h3>';
					} 
				?>
				
				
			</div>
			<!-- //btm-wthree-left -->
			<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>