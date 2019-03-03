<?php
	ob_start();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/templates/admin/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/templates/admin/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin - Share IT</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/templates/admin/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/templates/admin/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="/templates/admin/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/templates/admin/assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/templates/admin/assets/css/themify-icons.css" rel="stylesheet">
	<script type="text/javascript" src="/library/jquery-2.1.1.min.js"></script>
	<script src="/templates/admin/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="/library/jquery.validate.min.js" type="text/javascript"></script>
	<script src="/library/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script src="/library/ckfinder/ckfinder.js" type="text/javascript"></script>
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/admin" class="simple-text">AdminCP</a>
            </div>

            <ul class="nav">
			
				<?php 
					$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
					$admin = $_SERVER['REQUEST_URI'];
					
				?>
					
            	<li <?php if(strstr($url, "admin/cat")){ echo 'class="active"'; }  ?> >
					<?php
						$query1 = "SELECT COUNT(*) AS total1 FROM cat_list";
						$result1 = $mysqli->query($query1);
						$ar1 = mysqli_fetch_assoc($result1);
						$total1 = $ar1['total1'];
					?>
                    <a href="/admin/cat">
                        <i class="ti-map"></i>
                        <p>QUẢN LÝ DANH MỤC (<?php echo '<span style="color:red">'.$total1.'</span>'; ?>)</p>
                    </a>
                </li>	
            	<li <?php if(strstr($url, "admin/news")){ echo 'class="active"'; }  ?> >
					<?php
						$query2 = "SELECT COUNT(*) AS total2 FROM news";
						$result2 = $mysqli->query($query2);
						$ar2 = mysqli_fetch_assoc($result2);
						$total2 = $ar2['total2'];
					?>
                    <a href="/admin/news">
                        <i class="ti-view-list-alt"></i>
                        <p>QUẢN LÝ TIN TỨC (<?php echo '<span style="color:red">'.$total2.'</span>'; ?>)</p>
                    </a>
                </li>
                <li <?php if(strstr($url, "admin/users")){ echo 'class="active"'; }  ?> >
					<?php
						$query3 = "SELECT COUNT(*) AS total3 FROM user";
						$result3 = $mysqli->query($query3);
						$ar3 = mysqli_fetch_assoc($result3);
						$total3 = $ar3['total3'];
					?>
                    <a href="/admin/users">
                        <i class="ti-panel"></i>
                        <p>QUẢN LÝ NGƯỜI DÙNG (<?php echo '<span style="color:red">'.$total3.'</span>'; ?>)</p>
                    </a>
                </li>
                <li <?php if(strstr($url, "admin/comment")){ echo 'class="active"'; }  ?> >
					<?php
						$query4 = "SELECT COUNT(*) AS total4 FROM comment";
						$result4 = $mysqli->query($query4);
						$ar4 = mysqli_fetch_assoc($result4);
						$total4 = $ar4['total4'];
					?>
                    <a href="/admin/comment">
                        <i class="ti-user"></i>
                        <p>QUẢN LÝ BÌNH LUẬN (<?php echo '<span style="color:red">'.$total4.'</span>'; ?>)</p>
                    </a>
                </li>
				<li <?php if(strstr($url, "admin/slide")){ echo 'class="active"'; }  ?> >
					<?php
						$query5 = "SELECT COUNT(*) AS total5 FROM slide";
						$result5 = $mysqli->query($query5);
						$ar5 = mysqli_fetch_assoc($result5);
						$total5 = $ar5['total5'];
					?>
                    <a href="/admin/slide">
                        <i class="ti-id-badge"></i>
                        <p>QUẢN LÝ SLIDE (<?php echo '<span style="color:red">'.$total5.'</span>'; ?>)</p>
                    </a>
                </li>
				<li <?php if(strstr($url, "admin/contact")){ echo 'class="active"'; }  ?> >
					<?php
						$query6 = "SELECT COUNT(*) AS total6 FROM contact";
						$result6 = $mysqli->query($query6);
						$ar6 = mysqli_fetch_assoc($result6);
						$total6 = $ar6['total6'];
					?>
                    <a href="/admin/contact">
                        <i class="ti-help"></i>
                        <p>QUẢN LÝ Liện hệ (<?php echo '<span style="color:red">'.$total6.'</span>'; ?>)</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>	