<?php
	session_start();
	include '../config.php';
	$kode=$_GET['kk'];
	$smt=$_GET['smt'];

	if($_SESSION['status']!="siswa"){
		header("location:../index.php");
	}

	$user=$_SESSION['user'];
	$query="select * from siswa where nis='$user'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_array($result);
	$nama=$data['nama_siswa'];
	$kodesiswa=$data['kode_siswa'];

	if ($smt==01) {
		$kodesmt="Ganjil";
	}else{
		$kodesmt="Genap";
	}

	$querym="select distinct kelas.kode_kelas, kelas.kelas, kelas.peminatan, nilai.kode_kelas, nilai.kode_siswa from kelas, nilai where kelas.kode_kelas=nilai.kode_kelas and nilai.kode_siswa='$kodesiswa' order by kelas.kelas";
	$resultm=mysqli_query($koneksi,$querym);

	$querymp="select * from mpelajaran, kelas_siswa where kelas_siswa.kode_kelas=mpelajaran.kode_kelas and kelas_siswa.kode_siswa='$kodesiswa'";
	$resultmp=mysqli_query($koneksi,$querymp);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIASMKBI - Siswa</title>
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
									<?php 
										echo $nama;
									?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../logout.php"  title="keluar dari akun ini" class="logout">
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
						<a href="siswa.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="icon-book "></i>
							<span class="menu-text"> Data Penilaian </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
						<?php
							while ($datakls=mysqli_fetch_array($resultm)) {
								if ($kode==$datakls['kode_kelas']) {
									echo '<li class="active open">
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
									echo $datakls['kelas']." <br>".$datakls['peminatan'];
									echo '<b class="arrow icon-angle-down"></b></a>
										<ul class="submenu">';
									if ($smt==01) {
										echo '<li class="active">
											<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=01">
												<i class="icon-adjust"></i>Semester Ganjil
											</a>
										</li>
										<li>
											<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=11">
												<i class="icon-circle"></i>Semester Genap
											</a>
										</li>';
									}else{
										echo '<li>
											<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=01">
												<i class="icon-adjust"></i>Semester Ganjil
											</a>
										</li>
										<li class="active">
											<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=11">
												<i class="icon-circle"></i>Semester Genap
											</a>
										</li>';
									}
									echo '</ul>
										</li>';
								}else{
									echo '<li>
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
									echo $datakls['kelas']." <br>".$datakls['peminatan'];
									echo '<b class="arrow icon-angle-down"></b></a>
										<ul class="submenu">';
									echo '<li>
										<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=01">
											<i class="icon-adjust"></i>Semester Ganjil
										</a>
									</li>
									<li>
										<a href="penilaiansiswa.php?kk='.$datakls['kode_kelas'].'&&smt=11">
											<i class="icon-circle"></i>Semester Genap
										</a>
									</li>
								</ul>
							</li>';
								}
							}
						?>
						</ul>
					</li>
				</ul>
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
								<div class="row-fluid">
									<div class="span12">
										<div class="span8">
											Data Penilaian
											<?php
												if (isset($_POST['pilih'])) {
													$kmp=$_POST['pilihmp'];
													$queryp="select * from mpelajaran where kode_mp='$kmp'";
													$resultp=mysqli_query($koneksi,$queryp);
													$datap=mysqli_fetch_array($resultp);
													echo "Mata Pelajaran ".$datap['nama_mp'];
													$kkm=$datap['kkm'];
												}
											?>
										</div>
										<div class="span4">
											<form class="form-inline" method="post" action="#">
												<select class="input-large" name="pilihmp">
													<?php
										    		    while ($datamp=mysqli_fetch_array($resultmp)) {
										    				echo "<option value=".$datamp['kode_mp'].">".$datamp['nama_mp']."</option>";
													    }
													?>
												</select>
												<button class="btn btn-small btn-info" type="submit" name="pilih" value="submit" title="Pilih mata pelajaran ini">
													<i class="icon-ok"></i> Pilih
												</button>
											</form>
										</div>
									</div>
								</div>
							</h3>
							<?php 
								if (isset($_POST['pilih'])) {
									echo '<div class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>
										<strong>
											KKM : '.$kkm.'
										</strong>										
										<br />
									</div>';
								} 
							
								if (isset($_POST['pilih'])) {
									$kmp=$_POST['pilihmp'];
									$querypeng="select * from nilai where kode_siswa='$kodesiswa' and kode_mp='$kmp' and semester='$kodesmt'";
									$resultpeng=mysqli_query($koneksi,$querypeng);
									$resultpeng2=mysqli_query($koneksi,$querypeng);//tgspeng
									$resultpeng3=mysqli_query($koneksi,$querypeng);//uhpeng
									$resultpeng4=mysqli_query($koneksi,$querypeng);//tgsketer
									$resultpeng5=mysqli_query($koneksi,$querypeng);//uhketer
									$row=mysqli_fetch_array($resultpeng);							
									echo '<div class="table-header header-color-dark">
											Basis Pengetahuan
										</div>
										<table class="table table-striped table-bordered table-hover " >';
										//tgs peng										
									$jumlahtgsp=$row['jum_tgs_peng'];
									if ($jumlahtgsp==0) {
										echo '<tr><th>Tidak ada tugas yang dilakukan.</th></tr>';
									}else{
										while ($data=mysqli_fetch_array($resultpeng2)) {
											echo "<tr>";
											$i=1;
									 		while ($i<=$jumlahtgsp) {									
												echo '<th>Tugas '.$i.'</th>';
												$i++;
											}
											echo "</tr><tr>";
											$i=1;
											while ($i<=$jumlahtgsp) {									
												if ($data['tgs_peng'.$i.'']<$kkm) {
													echo '<td style="color:red">'.$data['tgs_peng'.$i.''].'</td>';
												}else{
													echo '<td>'.$data['tgs_peng'.$i.''].'</td>';
												}
												$i++;
											}
											echo "</tr>";
										}
									}
									echo '</table>
									<table class="table table-striped table-bordered table-hover ">';
									//uh peng
									$jumlahuhp=$row['jum_uh_peng'];
									if ($jumlahuhp==0) {
										echo '<tr><th>Tidak ada UH yang dilakukan.</th></tr>';
									}else{
										while ($data=mysqli_fetch_array($resultpeng3)) {
											echo "<tr>";
											$i=1;
									 		while ($i<=$jumlahuhp) {									
												echo '<th>UH '.$i.'</th>';
												$i++;
											}
											echo "</tr><tr>";
											$i=1;
											while ($i<=$jumlahuhp) {									
												if ($data['uh_peng'.$i.'']<$kkm) {
													echo '<td style="color: red">'.$data['uh_peng'.$i.''].'</td>';
												}else{
													echo '<td>'.$data['uh_peng'.$i.''].'</td>';
												}
												$i++;
											}
											echo "</tr>";
										}
									}
									echo '</table>';
									//keter
									echo '<div class="table-header header-color-dark">
											Basis Keterampilan
										</div>
										<table class="table table-striped table-bordered table-hover " >';
									//tgs keter										
									$jumlahtgsk=$row['jum_tgs_keter'];
									if ($jumlahtgsk==0) {
										echo '<tr><th>Tidak ada tugas yang dilakukan.</th></tr>';
									}else{
										while ($data=mysqli_fetch_array($resultpeng4)) {
											echo "<tr>";
											$i=1;
									 		while ($i<=$jumlahtgsk) {									
												echo '<th>Tugas '.$i.'</th>';
												$i++;
											}
											echo "</tr><tr>";
											$i=1;
											while ($i<=$jumlahtgsk) {									
												if ($data['tgs_keter'.$i.'']<$kkm) {
													echo '<td style="color: red">'.$data['tgs_keter'.$i.''].'</td>';
												}else{
													echo '<td>'.$data['tgs_keter'.$i.''].'</td>';
												}
												$i++;
											}
											echo "</tr>";
										}
									}
									echo '</table>
									<table class="table table-striped table-bordered table-hover ">';
									//uh keter
									$jumlahuhk=$row['jum_uh_keter'];
									if ($jumlahuhk==0) {
										echo '<tr><th>Tidak ada UH yang dilakukan.</th></tr>';
									}else{
										while ($data=mysqli_fetch_array($resultpeng5)) {
											echo "<tr>";
											$i=1;
									 		while ($i<=$jumlahuhk) {									
												echo '<th>UH '.$i.'</th>';
												$i++;
											}
											echo "</tr><tr>";
											$i=1;
											while ($i<=$jumlahuhk) {									
												if ($data['uh_keter'.$i.'']<$kkm) {
													echo '<td style="color: red">'.$data['uh_keter'.$i.''].'</td>';
												}else{
													echo '<td>'.$data['uh_keter'.$i.''].'</td>';
												}
												$i++;
											}
											echo "</tr>";
										}
									}
									echo '</table>';						
									echo '<div class="table-header header-color-dark">
											Penilaian Akhir
										</div>
										<table class="table table-striped table-bordered table-hover " >';
									//uts uas				
									$uts=$row['uts'];
									$uas=$row['uas'];
									echo '<tr>
											<th>UTS</th>
											<th>UAS</th>
										</tr>
										<tr>';
									if (($uts=='')&&($uas=='')) {
										echo '<td>Tidak ada UTS yang dilakukan.</td>';
										echo '<td>Tidak ada UAS yang dilakukan.</td>';
									}else if (($uts>=0)&&($uas=='')) {
										if ($uts<$kkm) {
												echo '<td style="color: red">'.$uts.'</td>';
											}else{
												echo "<td>".$uts."</td>";
											}
											echo '<td>Tidak ada  UAS yang dilakukan.</td>';
										}else if (($uts=='')&&($uas>=0)) {
											echo '<td>Tidak ada  UTS yang dilakukan.</td>';
											if ($uas<$kkm) {
													echo '<td style="color: red">'.$uas.'</td>';
												}else{
													echo "<td>".$uas."</td>";
												}
										}else{
											if ($uts<$kkm) {
													echo '<td style="color: red">'.$uts.'</td>';
												}else{
													echo "<td>".$uts."</td>";
												}
											if ($uas<$kkm) {
													echo '<td style="color: red">'.$uas.'</td>';
												}else{
													echo "<td>".$uas."</td>";
												}
										}
										echo "</tr></table>";
									}else{
										echo '<div class="alert alert-warning">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>Pilih mata pelajaran untuk menampilkan nilai.
										</div>';
								}
							?>	
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
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
		<script type="text/javascript">
			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});
		</script>
	</body>
</html>