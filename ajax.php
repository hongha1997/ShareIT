<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; ?>
<?php

if(!empty($_POST["id"])){
	
    $haha = $_POST["id"];
    // Count all records except already displayed
    //$query = $db->query("SELECT COUNT(*) as num_rows FROM posts WHERE id < ".$_POST['id']." ORDER BY id DESC");
    //$row = $query->fetch_assoc();
	//$query ="SELECT COUNT(*) AS num_rows FROM danhmuctin WHERE id_danhmuctin < {$haha} ORDER BY id_danhmuctin DESC";
	//$result = $mysqli->query($query);
	
	$query = "SELECT COUNT(*) AS num_rows FROM news WHERE news_id < {$haha} ORDER BY news_id DESC";
	$result = $mysqli->query($query);
	$arNews2 = mysqli_fetch_assoc($result);
	//$arNews = mysqli_fetch_assoc($result);
    $totalRowCount = $arNews2['num_rows'];
    ?>
	<div class="col-md-9 btm-wthree-left">
	<?php
    $showLimit = 5;
    
    // Get records from the database
    //$query = $db->query("SELECT * FROM posts WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT $showLimit");
	
	//$query2 ="SELECT * FROM danhmuctin WHERE id_danhmuctin < {$haha} ORDER BY id_danhmuctin DESC LIMIT {$showLimit}";
	//$result2 = $mysqli->query($query2);
	
	$query2 ="SELECT * FROM news WHERE news_id < {$haha} ORDER BY news_id DESC LIMIT {$showLimit}";
	$result2 = $mysqli->query($query2);
	while($arNews = mysqli_fetch_assoc($result2)){
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
							<a class="agileits w3layouts" href="<?php echo $url; ?>">Chi ti?t<span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
    <?php } ?>
    <?php if($totalRowCount > $showLimit){ ?>
        <div class="show_more_main" id="show_more_main<?php echo $news_id; ?>">
            <span id="<?php echo $news_id; ?>" class="show_more" title="Load more posts">Show more</span>
            <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
        </div></div>
<?php }} ?>