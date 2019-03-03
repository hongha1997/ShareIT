<?php
	ob_start();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Trang Chủ | Share IT</title>    
<link href="/templates/shareit/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" /><!-- fontawesome -->     
<link href="/templates/shareit/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" /><!-- Bootstrap stylesheet -->
<link href="/templates/shareit/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="/templates/shareit/css/flexslider.css" type="text/css" media="screen" property="" />
<!-- stylesheet -->
<!-- meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //meta tags -->
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!--//fonts-->
<script type="text/javascript" src="/templates/shareit/js/jquery-2.1.4.min.js"></script>


<!-- lOAD MOREAKDJAKSJDHSAKJH -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="/templates/shareit/js/main.js"></script>
<!-- Required-js -->
<!-- main slider-banner -->
<script src="/templates/shareit/js/skdslider.min.js"></script>
<link href="/templates/shareit/css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="/templates/shareit/js/move-top.js"></script>
<script type="text/javascript" src="/templates/shareit/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<!-- scriptfor smooth drop down-nav -->
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- //script for smooth drop down-nav -->
</head>
<?php 
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	$admin = $_SERVER['REQUEST_URI'];
?>
<body>
<!-- header -->
	<header>
		<div class="w3layouts-top-strip">
			<div class="container">
				<div class="logo">
					<h1><a href="/">SHARE IT</a></h1>
				</div>
			</div>
		</div>
		<!-- navigation -->
			<nav class="navbar navbar-default">
			  <div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php
						$query = "SELECT * FROM cat_list WHERE parent_id = 0";
						$result = $mysqli->query($query);
						if($result->num_rows>0){
							echo '<ul class="nav navbar-nav">';
							while($ar = mysqli_fetch_assoc($result)){
								$id = $ar['cat_id'];
								$name = $ar['cat_name'];
								$name_seo = utf8ToLatin($name);
								$url = "/dm/".$name_seo."-".$id;
								$parent_id = $ar['parent_id'];		
									echo '<li class="dropdown">';
										// echo '<a  href="cat.php?id='.$id.'">'.$name.'</a>';
										?>
										<a <?php if($admin == $url){ echo 'style="color:red"'; } ?> href="<?php echo $url; ?>"><?php echo $name; ?></a>
										<?php
										 getSubmenu($id);
									echo '</li>';		
							}
							echo '</ul>';
						}
						function getSubmenu($haha) {
							global $mysqli;	
							$query2 = "SELECT * FROM cat_list WHERE parent_id = {$haha} ";
							$result2 = $mysqli->query($query2);
							if($result2->num_rows>0){
								echo '<ul class="dropdown-menu">';
								while($ar2 = mysqli_fetch_assoc($result2)){
									$id2 = $ar2['cat_id'];
									$name2 = $ar2['cat_name'];
									$name_seo2 = utf8ToLatin($name2);
									$url2 = "/dm/".$name_seo2."-".$id2;
									$parent_id2 = $ar2['parent_id'];		
										echo '<li class="dropdown">';
											// echo '<a href="cat.php?id='.$id2.'">'.$name2.'</a>';
											?>
											<a  href="<?php echo $url2; ?>"><?php echo $name2; ?></a>
											<?php
											 getSubmenu($id2);
										echo '</li>';		
								}
								echo '</ul>';
							}
						}
					?>
				</div><!-- /.navbar-collapse -->

				<div class="clearfix"> </div>

			  </div><!-- /.container-fluid -->
			</nav>
			
		<!-- //navigation -->
	</header>
	<!-- //header -->
	<!-- top-header and slider -->
	<div class="w3-slider">	
	<!-- main-slider -->
		<ul id="demo1">	
			<?php
				$querySlide = "SELECT * FROM slide ORDER BY id_slide DESC";
				$resultSlide = $mysqli->query($querySlide);
				while($arSlide = mysqli_fetch_assoc($resultSlide)){
					$id_slide = $arSlide['id_slide'];
					$anh_slide = $arSlide['anh_slide'];
					$trangthai_slide = $arSlide['trangthai_slide'];
					if($trangthai_slide==0){
			?>
			<li>				
				<img src="/files/slide/<?php echo $anh_slide; ?>" alt="" />					
				<!--Slider Description example-->
				<div class="slide-desc">
					<h3>Dự Án Share IT - VinaEnter Edu</h3>
				</div>				
			</li>
				<?php } } ?>
		</ul>
	</div>
	
	<!-- //banner -->
	