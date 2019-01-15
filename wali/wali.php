<?php
	session_start();
	include '../config.php';
	if($_SESSION['status']!="walikelas"){
		header("location:../loginwali.php");
	}
	$user=$_SESSION['user'];
	$query="select * from walikelas where user_wali='$user'";
	$result=mysqli_query($koneksi,$query);
    while($data=mysqli_fetch_array($result)){
        $nama=$data['user_wali'];
        $kelas=$data['kode_kelas'];}

	$query2="select * from kelas where kode_kelas='$kelas'";
	$result2=mysqli_query($koneksi,$query2);
	$datakls=mysqli_fetch_array($result2);
	$namakls=$datakls['kelas'];
	$peminatan=$datakls['peminatan'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIASMKBI - Wali Kelas</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="shortcut icon" href="../assets/images/logobi-10.png" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />

		<!--ace styles-->
		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	</head>
	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<img src="../assets/images/logobi-25.png" width="15%">SIA SMK BI
						</small>
					</a><!--/.brand-->
					<ul class="nav ace-nav pull-right">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php echo $nama ?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="#ganti_pass"  title="ganti password saat ini" data-toggle="modal">
										<i class="icon-lock"></i>Ubah Password
									</a>
								</li>
								<li>
									<a href="../logoutwali.php"  title="keluar dari akun ini" class="logout">
										<i class="icon-off"></i>Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<div class="sidebar" id="sidebar">
				<ul class="nav nav-list">
					<li class="active">
						<a href="wali.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-folder-open-alt "></i>
							<span class="menu-text"> Kelas </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li class="active open">
								<a href="#" class="dropdown-toggle">
									<i class="icon-double-angle-right"></i>
									<?php echo $datakls['kelas']." <br>".$datakls['peminatan']; ?>
									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
									<li>
										<?php echo '<a href="lihatkelas.php?kk='.$kelas.'&&smt=01">' ?>
											<i class="icon-adjust"></i>Semester Ganjil
										</a>
									</li>
									<li>
										<?php echo '<a href="lihatkelas.php?kk='.$kelas.'&&smt=11">' ?>
											<i class="icon-circle"></i>Semester Genap
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="laporan.php">
							<i class="icon-book"></i>
							<span class="menu-text"> Laporan </span>
						</a>
					</li>
				</ul><!--/.nav-list-->
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>
			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							<h3 class="header smaller lighter blue">
								Data Wali Kelas
							</h3>
							<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
								Pastikan mengubah password terlebih dahulu saat pertama kali login demi keamanan pada menu pengguna di kanan atas.
							</div>
							Username : <?php echo $nama ?>
							<br>
							Wali Kelas    : <?php echo $namakls.' '; echo $peminatan; ?>
							<br>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
				<!-- ubah password			-->
				<div id="ganti_pass" class="modal hide fade" tabindex="-1">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>Ubah Password (maksimal 16 karakter)
						</div>
					</div>
					<div class="modal-body">
						<div class="control-group">
							<form method="post" action="#"> 
								<div class="controls">
									<label>
										Username : <?php echo $user ?>
									</label>
									<label>
										Password Lama
									</label>
									<input type="password" placeholder="Password Lama" name="passwordlama" required="required" autofocus maxlength="16"/>
									<label>
										Password Baru
									</label>
									<input type="password" placeholder="Password Baru" name="passwordbaru" required="required" autofocus maxlength="16"/>
									<label>
										Konfirmasi Password Baru
									</label>
									<input type="password" placeholder="Password Baru" name="passwordkonf" required="required" autofocus maxlength="16"/>
									<br>												
									<span class="pull-right">
										<button class="btn btn-small" data-dismiss="modal">
											<i class="icon-remove"></i>Cancel
										</button>
										<button class="btn btn-small btn-primary" type="submit" name="submitgantipass" value="submit">
											<i class="icon-ok"></i>Save
										</button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<!--ganti pass-->				
					<?php
						include '../config.php';
						if(isset($_POST['submitgantipass'])){
							$passlama=$_POST['passwordlama'];
							$passbaru=$_POST['passwordbaru'];
							$passkon=$_POST['passwordkonf'];
							$query="select * from walikelas where user_wali='$user' and pass='$passlama'";
							$result=mysqli_query($koneksi,$query);
							$row=mysqli_num_rows($result);

							if($row!=1){
								echo "<script type='text/javascript'>alert('Password lama salah.')</script>";
							}else if($passbaru!=$passkon){
								echo "<script type='text/javascript'>alert('Konfirmasi password tidak sama.')</script>";
							}else if ($row==1) {
								$querypass="update walikelas set pass='$passbaru' where user_wali='$user'";
								$resultpass=mysqli_query($koneksi,$querypass);
								if ($resultpass) {
									echo "<script type='text/javascript'>alert('Password berhasil diubah.')</script>";
								}else{
									echo "<script type='text/javascript'>alert('Password gagal diubah. Coba lain kali.')</script>";
								}
							}
						}
					?>
					</div>
				</div><!--/.page-content-->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>
					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-class="default" value="#438EB9">#438EB9</option>
									<option data-class="skin-1" value="#222A2D">#222A2D</option>
									<option data-class="skin-2" value="#C6487E">#C6487E</option>
									<option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>
						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>
						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>
						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>
						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<script>
			$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
	</body>
</html>