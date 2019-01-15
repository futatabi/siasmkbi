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
        $kelas=$data['kode_kelas'];
    }

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
					<li>
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
					<li class="active">
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
							<div class="table-header" style="line-height: 340%">
								<form class="form-inline" method="post" action="#">
									<div class="row-fluid">
										<label>Semester : </label>
											<select class="input-small" name="smt">
												<?php
													if ($_POST['smt']==01) {
														echo '<option value="01" selected="selected">Ganjil</option>
															<option value="11">Genap</option>';
													}else if ($_POST['smt']==11) {
														echo '<option value="01">Ganjil</option>
															<option value="11" selected="selected">Genap</option>';
													}else{
														echo '<option value="01">Ganjil</option>
															<option value="11">Genap</option>';
													}
												?>
											</select>
										<label>Laporan :</label>
										<select class="input-small" name="laporan">
											<?php
												if ($_POST['laporan']==L) {
													echo '<option value="L" selected="selected">Leger</option>
														<option value="R">Rapor</option>';
												}else if ($_POST['laporan']==R) {
													echo '<option value="L">Leger</option>
														<option value="R" selected="selected">Rapor</option>';
												}else{
													echo '<option value="L">Leger</option>
														<option value="R">Rapor</option>';
												}
											?>
										</select>
										<label>Siswa :</label>
										<select name="kodes">
											<?php
												$querys="select * from siswa, kelas_siswa where siswa.kode_siswa=kelas_siswa.kode_siswa and kode_kelas='$kelas' order by nama_siswa";
												$results=mysqli_query($koneksi,$querys);
												while($datas=mysqli_fetch_array($results)){
													if ($_POST['kodes']==$datas['kode_siswa']) {
														echo '<option value="'.$datas["kode_siswa"].'" selected="selected">'.$datas["nama_siswa"].'</option>';
													}else{
														echo '<option value="'.$datas["kode_siswa"].'">'.$datas["nama_siswa"].'</option>';
													}
												}
												echo '</select>';
											?>
										<button class="btn btn-small btn-info" type="submit" name="pilih" value="submit">
											<i class="icon-ok"></i> Tampilkan
										</button>
									</div>
								</form>													
							</div><!--/.table header-->
							<?php
								if(isset($_POST['pilih'])){	
									$lap=$_POST['laporan'];
									if ($lap=='L') {
										$smt=$_POST['smt'];
										$kk=$kelas;
										include 'leger.php';		
										echo '<div class="space-10"></div>';
										echo '<form class="inline" action="cetakleger.php?smt='.$smt.'&kk='.$kelas.'" method="POST">
											<button class="btn btn-small btn-success">Unduh Leger Ini</button>
										</form>';
									}else if ($lap=='R'){
										$smt=$_POST['smt'];
										$kk=$kelas;
										$ks=$_POST['kodes'];
										include 'rapor.php';				
										echo '<div class="space-10"></div>';
										echo '<form class="inline" action="cetakrapor.php?smt='.$smt.'&kk='.$kelas.'&ks='.$ks.'" method="POST">
											<button class="btn btn-small btn-success">Unduh Rapor Ini</button>
										</form>';
									}
								}
							?>
					
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