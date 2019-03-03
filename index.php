<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<?php 
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM news";
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
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="/">Trang chủ</a></li>
				<li class="active"></li>
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
					$query = "SELECT * FROM news ORDER BY news_id DESC LIMIT {$offset}, {$row_count} ";
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
						//setcookie('as', $created_by+1, time()+200 );
						//echo $_COOKIE["as"];
						//die();
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
			//$name2=$arCat['name'];
			//$name_seo2=utf8ToLatin($name2);
			//$url2='/dm/'.$name_seo2."_".$id.'/page='.'1';
			//$url2='index.php?page=1';
			$url2='/page-1';
			$prev=$current_page-1;											
			$next=$current_page+1;											
			if($current_page > 1 && $tongSoTrang > 1){
				
					//$name2=$arCat['name'];
					// $name_seo2=utf8ToLatin($name2);
					//$urlp='/dm/'.$name_seo2."_".$id.'/page='.$prev; 
					//$urlp='index.php?page='.$prev; 
					$urlp='/page-'.$prev; 
				?>
				<li class="" ><a href="<?php echo $urlp?>">PREV</a></li>
				<?php }?>
					<?php	
					  $limit=5  ;
							if ($current_page > ($limit/2))
																//hiển thị trang đầu
								?>
								<li class=" " ><a href="<?php echo $url2?>">1</a></li>
								<li><span id="sp">...</span></li>
								<?php 
						if ($tongSoTrang >=1 && $current_page <= $tongSoTrang)
						{
							$counter = 1;
							
							
							for ($i=$current_page; $i<=$tongSoTrang;$i++)
							{
								//$name2=$arCat['name'];
								 //$name_seo2=utf8ToLatin($name2);
								// $url2='/dm/'.$name_seo2."_".$id.'/page='.$i;
								// $url2='index.php?page='.$i;
								 $url2='/page-'.$i;
								 
								if($counter < $limit){
									$active='';
									if($i==$current_page){
										$active='active';
									}
							?>	
									<li class=" <?php echo $active?>" ><a href="<?php echo $url2?>"><?php echo $i?></a></li>
								<?php	
								$counter++;
								}
							}
							//hiển thị trang cuối
							if ($current_page < $tongSoTrang - ($limit/2))
								?>	<li><span id="sp">...</span></li>
									<li class=" <?php //echo $active?>" ><a href="<?php echo $url2?>"><?php echo $tongSoTrang?></a></li>
								<?php
								}
								?>
					
					
					<?php
						
					if ($current_page < $tongSoTrang && $tongSoTrang > 1){
							
							//$name2=$arCat['name'];
							// $name_seo2=utf8ToLatin($name2);
							// $urln='/dm/'.$name_seo2."_".$id.'/page='.$next;
							 //$urln='index.php?page='.$next;
							 $urln='/page-'.$next;
						 ?>
						  <li class="" ><a href="<?php echo $urln?>">NEXT</a></li>
						
					<?php
					}
				   ?>
				
				
					
				</ul>
			</div>
			<!-- //btm-wthree-left -->
			<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>