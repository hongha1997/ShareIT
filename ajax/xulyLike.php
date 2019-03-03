<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; ?>
<?php
		$id_comment = $_POST['aIdComment'];
		$id_news = $_POST['aIdNews'];
		$query = "UPDATE comment SET likeCm = likeCm+1 WHERE id_comment = '{$id_comment}'";
		$result = $mysqli->query($query);
		?>
<h3>Comments</h3><br>
				<?php 
					$query3 = "SELECT COUNT(*) AS total FROM comment WHERE trangthai = 0 AND id_news = {$id_news} ";
					$result3 = $mysqli->query($query3); 
					$arCm2 = mysqli_fetch_assoc($result3);
					echo '<h5>- Có '.$arCm2['total'].' comments</h5>';
				?>
				<?php
				$query2 = "SELECT * FROM comment WHERE id_news = {$id_news} ";
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
									<li><a href="javascript:void(0)" onclick="return getLike(<?php echo $id_comment; ?>,<?php echo $id_news; ?>)">Thích</a></li>
									-  <li><a href="">Reply</a></li>
								
									<?php if($likeCm>0){ ?>
									-    <li><img src="/templates/admin/assets/img/like.png"/><?php echo $likeCm; ?></li>
					
									<?php } ?>
								</ul>
								<p><?php echo $comment; ?></p>
							</div>
							<div class="clearfix"> </div>
						</div>				
					</div>			
				</div>
				<?php }} ?>
				