<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<script> 
					$(document).ready(function(){
						$("#flip").click(function(){
							$("#panel").slideToggle("slow");
						});
					});
				</script>	
				<style> 
				#panel, #flip {
					padding: 5px;
					text-align: center;
					background-color: #e5eecc;
					border: solid 1px #c3c3c3;
				}

				#panel {
					padding: 50px;
					display: none;
				}
				</style> 
<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="/">Trang chủ</a></li>
				<?php
					$news_id = 0;
					if(isset($_GET['id'])){
						$news_id = $_GET['id'];	
					}
					$query4 = "SELECT * FROM news WHERE news_id = {$news_id}";
					$result4 = $mysqli->query($query4);
					$ar4 = mysqli_fetch_assoc($result4);
					$name = $ar4['news_name'];
				?>
				<li class="active">Chi tiết / <?php echo $name; ?></li>
				<script type="text/javascript">
					document.title='<?php echo $name; ?> | Share IT';
				</script>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
	<div class="container">
		<div class="banner-btm-agile">
		<!-- //btm-wthree-left -->
			<div class="col-md-9 btm-wthree-left">
				<div class="single-left">
				<?php 
					$news_id = 0;
					if(isset($_GET['id'])){
						$news_id = $_GET['id'];	
						//$query2 = "UPDATE news SET created_by = created_by + 1 WHERE news_id = {$news_id} ";
						//$result2 = $mysqli->query($query2);
					}
					$query = "SELECT * FROM news WHERE news_id = {$news_id}";
					$result = $mysqli->query($query);
					$arDetail = mysqli_fetch_assoc($result);
						$news_id = $arDetail['news_id'];
						$news_name = $arDetail['news_name'];
						$news_preview = $arDetail['news_preview'];
						$news_detail = $arDetail['news_detail'];
						$date_create = $arDetail['date_create'];
						$date_create = date("j / n / Y");						
						$created_by = $arDetail['created_by']+1;	
						setcookie('as', $created_by, time()+6000 );
						$haha =  $_COOKIE["as"];
						echo $haha;
						//die();
						$picture = $arDetail['picture'];	
						$cat_id = $arDetail['cat_id'];	
						$is_slide = $arDetail['is_slide'];
						//setcookie("color","red");
						//echo $_COOKIE["color"];
						if(isset($haha)){
						$query2 = "UPDATE news SET created_by = {$haha} WHERE news_id = {$news_id} ";
						$result2 = $mysqli->query($query2);
						}
						//echo $_COOKIE["as"];
						//echo $haha;
						//die();
				?>
				<div class="single-left1">
					<?php if($picture!=""){ ?>
					<img src="/files/<?php echo $picture; ?>" alt=" " class="img-responsive" />
					<?php } ?>
					<h3><?php echo $news_name; ?></h3>
					<ul>
						<li><a href=""><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $date_create; ?></a></li>
						<li><a href=""><i class="fa fa-eye" aria-hidden="true"></i><?php echo $haha; ?></a></li>
						<?php
							$query5 = "SELECT COUNT(*) AS tong FROM comment WHERE id_news = {$news_id}";
							$result5 = $mysqli->query($query5);
							$ar5 = mysqli_fetch_assoc($result5);
							$tong = $ar5['tong'];
						?>
						<li><a href=""><i class="fa fa-comment" aria-hidden="true"></i><?php echo $tong; ?> COMMENTS</a></li>					
					</ul>
					<p><?php echo $news_detail; ?></p>
				</div>
				<div class="single-left2">
					<h4>Tin liên quan</h4><br/>
					<div class="col-md-6 single-left2-left">
						<ul>
							<?php
								$tam = 0;
								if($cat_id != '' ){
									$tam = $cat_id ;
								}
								$queryLQ = "SELECT * FROM news WHERE news_id != {$news_id} AND cat_id = {$tam} ORDER BY news_id DESC  LIMIT 3";
								$resultLQ = $mysqli->query($queryLQ);
								while($arNewsLQ = mysqli_fetch_assoc($resultLQ)){
									$news_id2 = $arNewsLQ['news_id'];
									$news_name2 = $arNewsLQ['news_name'];
									$name_seo =utf8ToLatin($news_name2);
									$picture2 = $arNewsLQ['picture'];	
									$url ="/".$name_seo."-".$news_id2.".html";
							?>
							<li>
								<?php if($picture2!=""){ ?>
								<a href="<?php echo $url; ?>"><img src="/files/<?php echo $picture2; ?>" width="120px" height="90px"/></a>
								<?php } ?>
								<h4><span class="glyphicon glyphicon-arrow-right" aria-hidden="true">
								</span><a href="<?php echo $url; ?>"><?php echo $news_name2; ?></a></h4>
							</li>
								<?php } ?>
						</ul>
					</div>
					<div class="clearfix"> 
					</div>
				</div>
				<div class="leave-coment-form">
					<h3>Your Comment</h3>
					
					
					<form action="javascript:void(0)" method="post">
						<input type="text" name="nameCm" id="nameCm" placeholder="Name" required="">
						<input type="email" name="emailCm" id="emailCm" placeholder="Email" required="">
						<textarea name="comment" id="comment" placeholder="Your comment here..." required=""></textarea>
						<div class="w3_single_submit">
							<input type="submit" name="submit" onclick="return getComment()" value="Submit Comment" >
						</div>
					</form>
				</div>
				
				
				
				<div id="ketqua">
				<h3>Comments</h3><br>
				<?php 
					$query3 = "SELECT COUNT(*) AS total FROM comment WHERE trangthai = 0 AND id_news = {$news_id} ";
					$result3 = $mysqli->query($query3); 
					$arCm2 = mysqli_fetch_assoc($result3);
					echo '<h5>- Có '.$arCm2['total'].' comments</h5>';
				?>
				<?php
				$query2 = "SELECT * FROM comment WHERE id_news = {$news_id} ";
				$result2 = $mysqli->query($query2);				
				while($arCm = mysqli_fetch_assoc($result2)){
					$nameCm = $arCm['name'];
					$id_comment = $arCm['id_comment'];
					$emailCm = $arCm['email'];
					$comment = $arCm['noidung'];	
					$trangthai = $arCm['trangthai'];
					$ngaytao = $arCm['ngaytao'];
					$ngaytao = date("j / n / Y");	
					$likeCm = $arCm['likeCm'];
					if($trangthai==0){	
				?>
				
				
				
				<div class="comments">
					<div class="comments-grids">
						<div class="comments-grid">
							<div class="comments-grid-left">
								<img src="/templates/shareit/images/avatar.png" alt=" " class="img-responsive" />
							</div>
							<div class="comments-grid-right">
								<h4><?php echo $nameCm; ?></h4>
								<ul>
									<li><?php echo $ngaytao; ?><i>|  </i></li>
									-  <li><div id="flip">Reply</div></li>
									
								</ul>
								<p><?php echo $comment; ?></p>
								<div id="panel">
									<form action="" method="post">
										<input type="text" name="Reply" id="Reply" placeholder="Reply" required="">
										<div class="w3_single_submit">
											<input type="submit" name="submit"  value="Submit Comment" >
										</div>
									</form>
									</div>
							</div>
							<div class="clearfix"> </div>
						</div>				
					</div>			
				</div>
				<?php }} ?>
				</div>
				<script type="text/javascript">
					function getComment(){
							var nameCm = $("#nameCm").val();
							var emailCm = $("#emailCm").val();
							var comment = $("#comment").val();
							var idNews = <?php echo $news_id; ?>;
							if(nameCm =="" || comment=="" || emailCm==""){
								alert("Mời nhập đủ thông tin.");
							} 
							else {
							$.ajax({
								url: 'ajax/xulyComment.php',
								type: 'POST',  // POST or GET
								cache: false, // true là lưa lại thông tin, false ko lưu, có thể xóa
								data: {
									aNameCm: nameCm, 
									aEmailCm: emailCm, 
									aComment: comment,
									aIdNews: idNews
								},
								success: function(data){ // dữ liệu lấy qua biến data
									//$('.jquery-demo-ajax').html(data);
									//alert(data);
									$('#ketqua').html(data);
								},
								error: function (){
									alert('Có lỗi xảy ra');
								}
							});
							return false;
					}}
				</script>
				<script type="text/javascript">
					function getLike(tam, tam2){
							
							var idComment = tam;
							var idNews = tam2;
							$.ajax({
								url: 'ajax/xulyLike.php',
								type: 'POST',  // POST or GET
								cache: false, // true là lưa lại thông tin, false ko lưu, có thể xóa
								data: {
									aIdComment: idComment,
									aIdNews: idNews
								},
								success: function(data){ // dữ liệu lấy qua biến data
									//$('.jquery-demo-ajax').html(data);
									//alert(data);
									$('#ketqua').html(data);
								},
								error: function (){
									alert('Có lỗi xảy ra');
								}
							});
							return false;
					}
				</script>
			</div>

			</div>
			<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>