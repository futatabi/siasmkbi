<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login - SMK</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="shortcut icon" href="assets/images/logobi-10.png" /> 
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->
		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!--ace styles-->
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	</head>
	<body class="login-layout" style="background-image: url(assets/images/bg.jpg);background-size: cover; ">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="span3 center">
									<img src="assets/images/logobi-25.png" style="vertical-align: middle;padding-top: 30%">
								</div>
								<div class="span9 center">
									<h1>
										<span class="green">Sistem Informasi</span>
										<span class="purple">Akademik</span>
									</h1>
									<h4 class="orange"> SMK Bakti Idhata</h4>
								</div>
							</div>
							<div class="space-6"></div>
							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-header">
											<h5 class="bigger lighter">Silakan Login Sebagai :</h5>
											<div class="widget-toolbar">
												<div class="btn-group">
													<button data-toggle="dropdown" class="btn btn-default btn-small dropdown-toggle">Lainnya
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu dropdown-default pull-right">
														<li>
															<a href="index.php">
																<i class="icon-user"></i> Siswa
															</a>
														</li>
														<li class="disabled">
															<a href="loginguru.php">
																<i class="icon-beaker"></i> Guru
															</a>
														</li>
														<li>
															<a href="loginwali.php">
																<i class="icon-group"></i> Wali Kelas
															</a>
														</li>
														<li>
															<a href="loginadm.php">
																<i class="icon-coffee"></i> Admin
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header orange lighter bigger">
													<i class="icon-beaker orange"></i>
													<b>Guru</b>
												</h4>
												<div class="space-6"></div>
												<form action="guru/cekguru.php" method="post">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" placeholder="Username (NIP)" name="username" required="required" autofocus/>
																<i class="icon-user"></i>
															</span>
														</label>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Password" name="password" required="required" autofocus/>
																<i class="icon-lock"></i>
															</span>
														</label>
														<div class="space"></div>
														<div class="clearfix">
															<button class="width-35 pull-right btn btn-small btn-warning" type="submit" value="submit" name="login">
																<i class="icon-key"></i>Login
															</button>
														</div>
														<div class="space-4"></div>
													</fieldset>
												</form>
											</div><!--/widget-main-->
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->

		<!--basic scripts-->

		<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

	</body>
</html>