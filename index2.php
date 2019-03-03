<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>

<?php 
	// tổng số dòng
	//$queryTSD = "SELECT COUNT(*) AS TSD FROM news";
	//$resultTSD = $mysqli->query($queryTSD);
	//$arTmp = mysqli_fetch_assoc($resultTSD);
	//$tongSoDong = $arTmp['TSD'];
	// số truyện trên 1 trang
	//$row_count = ROW_COUNT;
	// tổng số trang
	//$tongSoTrang = ceil($tongSoDong/$row_count);
	// trang hiện tại
	//$current_page = 1;
	//if(isset($_GET['page'])){
	//	$current_page = $_GET['page'];
	//}
	// offset
	//$offset = ($current_page - 1) * $row_count;
?>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'ajax.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
            }
        });
    });
});
</script>
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
			<div class="postList" >
			<div class="col-md-9 btm-wthree-left">
				<?php
					$query = "SELECT * FROM news ORDER BY news_id DESC LIMIT 5 ";
					$result = $mysqli->query($query);
					while($arNews = mysqli_fetch_assoc($result)){
						$news_id = $arNews['news_id'];
						$news_name = $arNews['news_name'];
						
						//$name_seo =utf8ToLatin($news_name);
						
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

						//$url ="/".$name_seo."-".$news_id.".html";
						
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
				<div class="show_more_main" id="show_more_main<?php echo $news_id; ?>">
					<span id="<?php echo $news_id; ?>" class="show_more" title="Load more posts">Show more</span>
					<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
				</div>
				<div class="clearfix"></div>
			</div>
			</div>
			<!-- //btm-wthree-left -->
			<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>