<!-- btm-wthree-right -->
			<div class="col-md-3 w3agile_blog_left">
			<?php 
				$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
				$admin = $_SERVER['REQUEST_URI'];
			?>
				<div class="wthreesearch">
							<form action="/tim-kiem" method="post">
								<input type="search" name="search" placeholder="Tìm kiếm tin..." required="">
								<button type="submit" name="submit" class="btn btn-default search" aria-label="Left Align">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						
				</div>
				<div class="w3ls_popular_posts">
					<h3>Bài viết mới</h3>
					
					<?php
						$query = "SELECT * FROM news ORDER BY news_id DESC LIMIT 3";
						$result = $mysqli->query($query);
						while($arStory = mysqli_fetch_assoc($result)){
							$news_id = $arStory['news_id'];
							$news_name = $arStory['news_name'];
							
							$name_seo3 = utf8ToLatin($news_name);
							
							$news_preview = $arStory['news_preview'];
							$news_detail = $arStory['news_detail'];
							$date_create = $arStory['date_create'];
							$date_create = date("j / n / Y");
							$created_by = $arStory['created_by'];	
							$picture = $arStory['picture'];	
							$cat_id = $arStory['cat_id'];	
							$is_slide = $arStory['is_slide'];	
							
							$url3 ="/".$name_seo3."-".$news_id.".html";
							
					?>
					
					<div class="agileits_popular_posts_grid">
						<div class="w3agile_special_deals_grid_left_grid">
							<a href="<?php echo $url3; ?>"><img src="/files/<?php echo $picture ?>" class="img-responsive" alt="" /></a>
						</div>
						<h4><a href="<?php echo $url3; ?>"><?php echo $news_name ?></a></h4>
						<i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date_create ?>
						<i class="fa fa-eye" aria-hidden="true"></i><?php echo $created_by; ?>
					</div>
					
					<?php } ?>
					
				</div>
				
				<div class="w3l_categories">
					<h3>Danh mục Lập trình</h3>
					<?php
						$query = "SELECT * FROM cat_list WHERE parent_id = 3";
						$result = $mysqli->query($query);
						if($result->num_rows>0){
							echo '<ul>';
							while($ar = mysqli_fetch_assoc($result)){
								$id = $ar['cat_id'];
								$name = $ar['cat_name'];
								$name_seo = utf8ToLatin($name);
								$url = "/dm/".$name_seo."-".$id;
								$parent_id = $ar['parent_id'];		
									echo '<li>';
										 //echo '<a  href="cat.php?id='.$id.'"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>'.$name.'</a>';
										 ?>
										 <a <?php if($admin == $url){ echo 'style="color:red"'; } ?>  href="<?php echo $url; ?>"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span><?php echo $name; ?></a>
										<?php
									echo '</li>';		
							}
							echo '</ul>';
						}
					?>
				</div>
			<div class="w3ls_recent_posts">
					<h3>Tin xem nhiều</h3>
					
					<?php
						$query = "SELECT * FROM news ORDER BY created_by DESC LIMIT 3";
						$result = $mysqli->query($query);
						while($arStory = mysqli_fetch_assoc($result)){
							$news_id = $arStory['news_id'];
							$news_name = $arStory['news_name'];
							
							$name_seo4 = utf8ToLatin($news_name);
							
							$news_preview = $arStory['news_preview'];
							$news_detail = $arStory['news_detail'];
							$date_create = $arStory['date_create'];	
							$date_create = date("j / n / Y");
							$created_by = $arStory['created_by'];	
							$picture = $arStory['picture'];	
							$cat_id = $arStory['cat_id'];	
							$is_slide = $arStory['is_slide'];	
							
							$url4 ="/".$name_seo4."-".$news_id.".html";
							
					?>
					
					<div class="agileits_recent_posts_grid">
						<div class="agileits_recent_posts_gridl">
							<div class="w3agile_special_deals_grid_left_grid">
								<a href="<?php echo $url4; ?>"><img src="/files/<?php echo $picture ?>" class="img-responsive" alt="" /></a>
							</div>
						</div>
						<div class="agileits_recent_posts_gridr">
							<h4><a href="<?php echo $url4; ?>"><?php echo $news_name; ?></a></h4>
							<i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date_create; ?>
							<i class="fa fa-eye" aria-hidden="true"></i><?php echo $created_by; ?>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<?php } ?>
					
				</div>
			<div class="w3l_tags">
					<h3>Tất cả các mục</h3>
					<?php
						$query = "SELECT * FROM cat_list";
						$result = $mysqli->query($query);
						if($result->num_rows>0){
							echo '<ul class="tag">';
							while($ar = mysqli_fetch_assoc($result)){
								$id = $ar['cat_id'];
								$name = $ar['cat_name'];
								$name_seo2 = utf8ToLatin($name);
								$url2 = "/dm/".$name_seo2."-".$id;
								$parent_id = $ar['parent_id'];		
									echo '<li>';
										 //echo '<a href="cat.php?id='.$id.'">'.$name.'</a>';
										 ?>
										 <a <?php if($admin == $url2){ echo 'style="color:red"'; } ?> href="<?php echo $url2; ?>"><?php echo $name; ?></a>
										 <?php
									echo '</li>';		
							}
							echo '</ul>';
						}
					?>
				</div>
			</div>