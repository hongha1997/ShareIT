<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<script type="text/javascript">
		document.title='Liên Hệ | Share IT';
	</script>
<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="/">Trang chủ</a></li>
				<li class="active">Liên hệ</li>
			</ol>
		</div>
	</div>
	<!-- contact -->
	<div class="container">
		<!-- mail -->
	<div class="banner-bottom">
			<div class="agileits_heading_section">
				<h3 class="wthree_head">Liên hệ cho chúng tôi</h3>
			</div>
			<div class="w3ls_portfolio_grids w3_agile_mail_grids">	
				<?php
					$msg = "";
					$name = "";
					$email = "";
					$sdt = "";
					$contact = "";
					if(isset($_POST['submit'])){
						$name  = $_POST['name'];
						$email  = $_POST['email'];
						$sdt  = $_POST['sdt'];
						$contact  = $_POST['contact'];
						$query = "INSERT INTO contact (name_contact, email_contact, sdt_contact, contact) VALUES('{$name}', '{$email}', '{$sdt}', '{$contact}')";
						$result = $mysqli->query($query);
						if($result){
							$msg = "Thành công";
						}
					}
				?>
				<form action="" method="post">
					<div class="col-md-6 w3_agile_mail_grid">
						<span class="input input--ichiro">
							<input class="input__field input__field--ichiro" name="name" type="text" id="input-25" placeholder="" required="" />
							<label class="input__label input__label--ichiro" for="input-25">
								<span class="input__label-content input__label-content--ichiro">Your Name</span>
							</label>
						</span>
						<span class="input input--ichiro">
							<input class="input__field input__field--ichiro" name="email" type="email" id="input-26" placeholder=" " required="" />
							<label class="input__label input__label--ichiro" for="input-26">
								<span class="input__label-content input__label-content--ichiro">Your Email</span>
							</label>
						</span>
						<span class="input input--ichiro">
							<input class="input__field input__field--ichiro" name="sdt" type="text" id="input-27" placeholder=" " required="" />
							<label class="input__label input__label--ichiro" for="input-27">
								<span class="input__label-content input__label-content--ichiro">Your Phone Number</span>
							</label>
						</span>
						<input type="submit" name="submit" value="Submit">
					</div>
					<div class="col-md-6 w3_agile_mail_grid">
						<textarea name="contact" placeholder="Your message here..." required=""></textarea>
					</div>
					<div class="clearfix"> </div>
				</form>
				<?php echo $msg; ?>
			</div>
		
	</div>
<!-- //mail -->

	</div>
	<!-- //contact -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>