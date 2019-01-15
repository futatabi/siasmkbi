<?php
	session_start();
	include '../config.php';
	$kodemp=$_GET['kmp'];
	$smt=$_GET['smt'];

	if($_SESSION['status']!="gurump"){
		header("location:../loginguru.php");
	}
	$user=$_SESSION['user'];
	$query="select * from guru where nip='$user'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_array($result);
	$nama=$data['nama_guru'];
	$kodeg=$data['kode_guru'];

	$query2="select * from mpelajaran, kelas where mpelajaran.kode_guru='$kodeg' and mpelajaran.kode_kelas=kelas.kode_kelas";
	$result2=mysqli_query($koneksi,$query2);

	$query3="select * from mpelajaran, kelas where mpelajaran.kode_kelas=kelas.kode_kelas and mpelajaran.kode_mp='$kodemp'";
	$result3=mysqli_query($koneksi,$query3);
	$data3=mysqli_fetch_array($result3);
	//bobot
	$query4="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp='$kodemp'";
	$result4=mysqli_query($koneksi,$query4);
	$data4=mysqli_fetch_array($result4);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIASMKBI - Guru</title>
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
		<link rel="stylesheet" href="../assets/css/chosen.css" />
	
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
										echo $nama 
									?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../logoutguru.php" title="keluar dari akun ini" class="logout">
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
						<a href="guru.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="icon-folder-open-alt "></i>
							<span class="menu-text"> Daftar Kelas </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
						<?php 
							while ($datakls=mysqli_fetch_array($result2)) {
								if ($kodemp==$datakls['kode_mp']) {
									echo '<li class="active open">
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
									echo $datakls['kelas']." <br>".$datakls['peminatan'];
									echo '<b class="arrow icon-angle-down"></b></a>
											<ul class="submenu">';
									if ($smt==01) {
										echo '<li class="active">
												<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=01">
													<i class="icon-adjust"></i>Semester Ganjil
												</a>
											</li>
											<li>
												<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=11">
													<i class="icon-circle"></i>Semester Genap
												</a>
											</li>';
									}else{
										echo '<li>
												<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=01">
													<i class="icon-adjust"></i>Semester Ganjil
												</a>
											</li>
											<li class="active">
												<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=11">
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
											<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=01">
												<i class="icon-adjust"></i>Semester Ganjil
											</a>
										</li>
										<li>
											<a href="lihatkelas.php?kmp='.$datakls['kode_mp'].'&&smt=11">
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
							<div class="row-fluid">
								<div class="table-header">
									<form class="form-inline" method="post" action="#">
										<div class="row-fluid">
										<?php
											$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
											$ta=mysqli_query($koneksi,$queryta);
											$datata=mysqli_fetch_array($ta);
											$tampilkk=$datata['kode_kelas'];
											$tampilta=$datata['tahun_ajar'];

											echo "<b>Tahun Ajaran :</b> $tampilta | ";
											echo "<b>Kelas :</b> ".$data3['kelas']." ".$data3['peminatan']." | ";
											if ($smt==01) {
												$kodesmt="Ganjil";
												$ujian="UTS";
												$nujian="uts";
												$bobottgsp="bobot_tgsp_ga";
												$bobotuhp="bobot_uhp_ga";
												$bobottgsk="bobot_tgsk_ga";
												$bobotuhk="bobot_uhk_ga";
												$bobotuts="bobot_uts_ga";
												$bobotuas="bobot_uas_ga";
												$deskpa="peng_ga_a";
												$deskpb="peng_ga_b";
												$deskpc="peng_ga_c";
												$deskpd="peng_ga_d";
												$deskka="kete_ga_a";
												$deskkb="kete_ga_b";
												$deskkc="kete_ga_c";
												$deskkd="kete_ga_d";
											}else{
												$kodesmt="Genap";
												$ujian="UAS";
												$nujian="uas";
												$bobottgsp="bobot_tgsp_ge";
												$bobotuhp="bobot_uhp_ge";
												$bobottgsk="bobot_tgsk_ge";
												$bobotuhk="bobot_uhk_ge";
												$bobotuts="bobot_uts_ge";
												$bobotuas="bobot_uas_ge";
												$deskpa="peng_ge_a";
												$deskpb="peng_ge_b";
												$deskpc="peng_ge_c";
												$deskpd="peng_ge_d";
												$deskka="kete_ge_a";
												$deskkb="kete_ge_b";
												$deskkc="kete_ge_c";
												$deskkd="kete_ge_d";
											}
											echo "<b>Semester : </b>".$kodesmt." | ";
											echo "<b>KKM : </b>".$data3['kkm'];
										?>
										</div>
									</form>		
								</div>
								<div class="accordion" id="accordion2">
										<div class="accordion-group">
											<div class="accordion-heading">
												<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
													Silakan isi bobot nilai, jumlah tugas/UH dan deskripsi nilai kelas ini terlebih dahulu sebelum akses detail nilai siswa untuk proses nilai rapor semester 
													<?php 
														echo $kodesmt 
													?>
													dengan mengklik ini.
												</a>
											</div>
											<div class="accordion-body collapse" id="collapseOne">
												<div class="accordion-inner">
												<!--isian bobot & jumlah-->
													<form method="post" action="#" class="form-inline"> 
														<div class="clearfix">
															<div class="span4">
																<b>Penilaian Pengetahuan</b>
																<br>
																<small>jumlah bobot dalam % (0-100)</small>
																<br>
																<div class="span5">
																	<label>
																		Bobot Tugas
																	</label>
																	<br>
																	<input class="input-mini" type="number"  min="0" max="100" name="bobottgsp" value="<?php echo $data4[$bobottgsp];?>" />
																	<br>
																	<label>
																		Bobot UH 
																	</label>
																	<br>
																	<input class="input-mini" type="number"  min="0" max="100" name="bobotuhp" value="<?php echo $data4[$bobotuhp];?>" />
																</div>
																<div class="span5">
																	<label>
																		Bobot UTS
																	</label>
																	<br>
																	<input class="input-mini" type="number"  min="0" max="100" name="bobotuts" value="<?php echo $data4[$bobotuts];?>" /><br>
																	<label>
																		Bobot UAS
																	</label>
																	<br>
																	<input class="input-mini" type="number"  min="0" max="100" name="bobotuas" value="<?php echo $data4[$bobotuas];?>" />
																</div>
															</div>
															<div class="span4">
																<b>Penilaian Keterampilan</b>
																<br>
																<small>jumlah bobot dalam % (0-100)</small>
																<br>
																<label>
																	Bobot Tugas 
																</label><br>
																<input class="input-mini" type="number"  min="0" max="100" name="bobottgsk" value="<?php echo $data4[$bobottgsk];?>" />
																<br>
																<label>
																	Bobot UH 
																</label>
																<br>
																<input class="input-mini" type="number"  min="0" max="100" name="bobotuhk" value="<?php echo $data4[$bobotuhk];?>" />
															</div>
															<div class="span4">
																<span class="btn btn-small btn-inverse pull-right" data-html="true" data-original-title="Bobot penilaian diperlukan untuk mengolah nilai rapor, ditampilkan pada tabel di kolom Nilai P (nilai akhir basis pengetahuan) dan Nilai K (nilai akhir basis keterampilan)." data-placement="bottom" data-rel="tooltip"> ? 
																</span>
																<button class="btn btn-small btn-primary pull-right red" type="submit" name="submit" value="submit">
																	<i class="icon-ok"></i>Simpan
																</button>
															</div>
														</div>
													</form>
													<!--masukan -->				
													<?php
														$kodekelas=$data3['kode_kelas'];
														 //jumlah
														$query5="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg";
														$result5=mysqli_query($koneksi,$query5);
														$data5=mysqli_fetch_array($result5);

														if(isset($_POST['submit'])){
															if ($smt==01) {
																$bobottgspga=$_POST['bobottgsp'];
																$bobotuhpga=$_POST['bobotuhp'];
																$bobottgskga=$_POST['bobottgsk'];
																$bobotuhkga=$_POST['bobotuhk'];
																$bobotutsga=$_POST['bobotuts'];
																$bobotuasga=$_POST['bobotuas'];
																$bobotp=$bobottgspga+$bobotuhpga+$bobotutsga+$bobotuasga;
																$bobotk=$bobottgskga+$bobotuhkga;
																if ($bobotp==100&&$bobotk==100) {
																	$queryb="update mpelajaran set bobot_tgsp_ga='$bobottgspga', bobot_uhp_ga='$bobotuhpga', bobot_tgsk_ga='$bobottgskga', bobot_uhk_ga='$bobotuhkga', bobot_uts_ga='$bobotutsga', bobot_uas_ga='$bobotuasga' where kode_mp='$kodemp'";
																	$resultb=mysqli_query($koneksi,$queryb);
																	if($resultb){
																		echo "<script type='text/javascript'>alert('Berhasil update')</script>";
																		echo "<meta http-equiv='refresh' content='0'>";
																	}else{
																		echo "<script type='text/javascript'>alert('Gagal')</script>";
																	}
																}else if ($bobotp!=100) {
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Pengetahuan tidak 100')</script>";
																}else if ($bobotk!=100) {
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Keterampilan tidak 100')</script>";
																}else{
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Pengetahuan dan Keterampilan tidak 100')</script>";
																}
															}else{
																$bobottgspge=$_POST['bobottgsp'];
																$bobotuhpge=$_POST['bobotuhp'];
																$bobottgskge=$_POST['bobottgsk'];
																$bobotuhkge=$_POST['bobotuhk'];
																$bobotutsge=$_POST['bobotuts'];
																$bobotuasge=$_POST['bobotuas'];
																$bobotp=$bobottgspge+$bobotuhpge+$bobotutsge+$bobotuasge;
																$bobotk=$bobottgskge+$bobotuhkge;
																if ($bobotp==100&&$bobotk==100) {
																	$queryb="update mpelajaran set bobot_tgsp_ge='$bobottgspge', bobot_uhp_ge='$bobotuhpge', bobot_tgsk_ge='$bobottgskge', bobot_uhk_ge='$bobotuhkge', bobot_uts_ge='$bobotutsge', bobot_uas_ge='$bobotuasge' where kode_mp='$kodemp'";
																	$resultb=mysqli_query($koneksi,$queryb);
																	if($resultb){
																		echo "<script type='text/javascript'>alert('Berhasil update')</script>";
																		echo "<meta http-equiv='refresh' content='0'>";
																	}else{
																		echo "<script type='text/javascript'>alert('Gagal')</script>";
																	}
																}else if ($bobotp!=100) {
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Pengetahuan tidak 100')</script>";
																}else if ($bobotk!=100) {
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Keterampilan tidak 100')</script>";
																}else{
																	echo "<script type='text/javascript'>alert('Jumlah Bobot Pengetahuan dan Keterampilan tidak 100')</script>";
																}
															}
														}
													?>
													<hr>
													<form method="post" action="#" class="form-inline">
														<div class="clearfix">
															<div class="span4">
																<label>Jumlah Tugas Pengetahuan yang dilakukan (0-10)</label>
																<br>
																<input class="input-mini" type="number" placeholder="0-10" value="<?php echo $data5['jum_tgs_peng'] ?>" min="0" max="10" name="jumlahtgsp"  required="required" />
																<br>
																<label>Jumlah UH Pengetahuan yang dilakukan (0-6)</label>
																<br>
																<input class="input-mini" type="number" placeholder="0-6" value="<?php echo $data5['jum_uh_peng'] ?>" min="0" max="6" name="jumlahuhp"  required="required" />
																<br>
															</div>
															<div class="span4">
																<label>Jumlah Tugas Keterampilan yang dilakukan (0-10)</label>
																<br>
																<input class="input-mini" type="number" placeholder="0-10" value="<?php echo $data5['jum_tgs_keter'] ?>" min="0" max="10" name="jumlahtgsk"  required="required" />
																<br>
																<label>Jumlah UH Keterampilan yang dilakukan (0-6)</label>
																<br>
																<input class="input-mini" type="number" placeholder="0-6" value="<?php echo $data5['jum_uh_keter'] ?>" min="0" max="6" name="jumlahuhk"  required="required" />
																<br>
															</div>
															<div class="span4">
																<span class="btn btn-small btn-inverse pull-right" data-html="true" data-original-title="Jumlah tugas atau UH akan ditambahkan pada halaman pada menu detail di tabel. Jika tidak ada tugas atau UH, isikan 0.<br> Mohon jumlah di update setiap akan dilakukan tugas atau UH agar nilainya dapat dimasukkan"  data-rel="tooltip" data-placement="bottom"> ? 
																</span>
																<button class="btn btn-small btn-primary pull-right save_j" type="submit" name="submit2" value="submit">
																	<i class="icon-ok"></i>Simpan
																</button>
															</div>
														</div>
													</form>
													<!--masukan 2-->				
													<?php
														if(isset($_POST['submit2'])){
															$jtgsp=$_POST['jumlahtgsp'];
															$juhp=$_POST['jumlahuhp'];
															$jtgsk=$_POST['jumlahtgsk'];
															$juhk=$_POST['jumlahuhk'];

															$queryj="update nilai set jum_tgs_peng='$jtgsp', jum_uh_peng='$juhp', jum_tgs_keter='$jtgsk', jum_uh_keter='$juhk' where kode_kelas='$kodekelas' and kode_guru='$kodeg' and semester='$kodesmt'";
															$resultj=mysqli_query($koneksi,$queryj);
															if($resultj){
																echo "<script type='text/javascript'>alert('Berhasil update')</script>";
																echo "<meta http-equiv='refresh' content='0'>";
															}else{
																echo "<script type='text/javascript'>alert('Gagal')</script>";
															}
														}
													?>
													<hr>
													<form method="post" action="#" class="form-inline">
														<div class="clearfix">
															<div class="span4">
																<b>Deskripsi Pengetahuan</b>
																<br>
																<label>Jika Predikat Nilai A (>85)</label>
																<br>
																<textarea name="penga" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskpa]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai B (>70 - 85)</label>
																<br>
																<textarea name="pengb" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskpb]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai C (>55 - 70)</label>
																<br>
																<textarea name="pengc" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskpc]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai D (0 - 55)</label>
																<br>
																<textarea name="pengd" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskpd];
																	?>
																</textarea>
																<br>
															</div>
															<div class="span4">
																<b>Deskripsi Keterampilan</b>
																<br>
																<label>Jika Predikat Nilai A (>85)</label>
																<br>
																<textarea name="ketera" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskka]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai B (>70 - 85)</label>
																<br>
																<textarea name="keterb" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskkb]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai C (>55 - 70)</label>
																<br>
																<textarea name="keterc" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskkc]; 
																	?>
																</textarea>
																<br>
																<label>Jika Predikat Nilai D (0 - 55)</label>
																<br>
																<textarea name="keterd" class="span12 limited autosize-transition" data-maxlength="160" required="required">
																	<?php 
																		echo $data4[$deskkd]; 
																	?>
																</textarea>
																<br>
															</div>
															<div class="span4">
																<span class="btn btn-small btn-inverse pull-right" data-html="true" data-original-title="Deskripsi ini akan muncul di rapor siswa berdasarkan predikat nilai yang didapat siswa yang bersangkutan"  data-rel="tooltip" data-placement="bottom"> ? 
																</span>
																<button class="btn btn-small btn-primary pull-right save_d" type="submit" name="submit3" value="submit">
																	<i class="icon-ok"></i>Simpan
																</button>
															</div>
															<?php
																if(isset($_POST['submit3'])){	
																	if ($smt==01) {
																		$penggaa=$_POST['penga'];
																		$penggab=$_POST['pengb'];
																		$penggac=$_POST['pengc'];
																		$penggad=$_POST['pengd'];
																		$ketegaa=$_POST['ketera'];
																		$ketegab=$_POST['keterb'];
																		$ketegac=$_POST['keterc'];
																		$ketegad=$_POST['keterd'];
																		$queryd="update mpelajaran set peng_ga_a='$penggaa', peng_ga_b='$penggab', peng_ga_c='$penggac', peng_ga_d='$penggad', kete_ga_a='$ketegaa', kete_ga_b='$ketegab', kete_ga_c='$ketegac', kete_ga_d='$ketegad' where kode_mp='$kodemp'";
																		$resultd=mysqli_query($koneksi,$queryd);
																			if($resultd){
																				echo "<script type='text/javascript'>alert('Berhasil update')</script>";
																				echo "<meta http-equiv='refresh' content='0'>";
																			}else{
																				echo "<script type='text/javascript'>alert('Gagal')</script>";
																			}
																	}else{
																		$penggea=$_POST['penga'];
																		$penggeb=$_POST['pengb'];
																		$penggec=$_POST['pengc'];
																		$pengged=$_POST['pengd'];
																		$ketegea=$_POST['ketera'];
																		$ketegeb=$_POST['keterb'];
																		$ketegec=$_POST['keterc'];
																		$keteged=$_POST['keterd'];
																		$queryd="update mpelajaran set peng_ge_a='$penggea', peng_ge_b='$penggeb', peng_ge_c='$penggec', peng_ge_d='$pengged', kete_ge_a='$ketegea', kete_ge_b='$ketegeb', kete_ge_c='$ketegec', kete_ge_d='$keteged' where kode_mp='$kodemp'";
																		$resultd=mysqli_query($koneksi,$queryd);
																			if($resultd){
																				echo "<script type='text/javascript'>alert('Berhasil update')</script>";
																				echo "<meta http-equiv='refresh' content='0'>";
																			}else{
																				echo "<script type='text/javascript'>alert('Gagal')</script>";
																			}
																	}
																}
															?>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<table id="tabel-mp" class="table table-striped table-bordered table-hover ">
										<thead>
											<tr>
												<th>
													<abbr title="Nama Siswa" data-rel="tooltip">Nama</abbr>
												</th>
												<th>
													<abbr title="Jenis Kelamin" data-rel="tooltip">JK</abbr>
												</th>
												<th>
													<abbr title="Agama" data-rel="tooltip">Agama</abbr>
												</th>
												<th>
													<abbr title="Rerata Nilai Tugas Pengetahuan" data-rel="tooltip">Tugas P</abbr>
												</th>
												<th>
													<abbr title="Rerata Nilai Ulangan Harian Pengetahuan" data-rel="tooltip">UH P</abbr>
												</th>
												<th>
													<abbr title="Rerata Nilai Tugas Keterampilan" data-rel="tooltip">Tugas K</abbr>
												</th>
												<th>
													<abbr title="Rerata Nilai Ulangan Harian Keterampilan" data-rel="tooltip">UH K</abbr>
												</th>
												<th>
													<abbr title="Nilai Ulangan Tengah Semester" data-rel="tooltip">UTS</abbr>
												</th>
												<th>
													<abbr title="Nilai Ulangan Akhir Semester" data-rel="tooltip">UAS</abbr>
												</th>
												<th>
													<abbr title="Nilai Akhir Pengetahuan" data-rel="tooltip">NA P</abbr>
												</th>
												<th>
													<abbr title="Nilai Akhir Keterampilan" data-rel="tooltip">NA K</abbr>
												</th>
												<th>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<!--tabel-->
											<?php
											    include '../config.php';
											    /*
												 if (strpos($data3['nama_mp'], 'Islam')!==false) {												
												echo "islam";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Islam%'";
												}else if (strpos($data3['nama_mp'], 'Kristen')!==false) {							
												echo "kris";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Kristen%'";
												}else if (strpos($data3['nama_mp'], 'Katolik')!==false) {							echo "Katolik";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Katolik%'";
												}else if (strpos($data3['nama_mp'], 'Hindu')!==false) {								echo "Hindu";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Hindu%'";
												}else if (strpos($data3['nama_mp'], 'Buddha')!==false) {							echo "button";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Buddha%'";
												}else if (strpos($data3['nama_mp'], 'Kong Hu Cu')!==false) {						echo "Kong";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg and siswa.agama like '%Kong Hu Cu'";
												}else{
												echo "biasa";
											    $querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg";
												}											    
												*/										    	
												$querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg";
												$resulttbl=mysqli_query($koneksi,$querytbl);
										    	while ($datatbl=mysqli_fetch_array($resulttbl)) {
										    		echo "<td>".$datatbl['nama_siswa']."</td>
											    		<td>".$datatbl['jk']."</td>
											    		<td>".$datatbl['agama']."</td>
											    		<td>".$datatbl['rerata_tgs_peng']."</td>
											    		<td>".$datatbl['rerata_uh_peng']."</td>
											    		<td>".$datatbl['rerata_tgs_keter']."</td>
											    		<td>".$datatbl['rerata_uh_keter']."</td>
											    		<td>".$datatbl['uts']."</td>
											    		<td>".$datatbl['uas']."</td>
											    		<td>".$datatbl['nilai_peng']."</td>
											    		<td>".$datatbl['nilai_keter']."</td>";
										    		echo '<td class="td-actions">
														<div class="hidden-phone visible-desktop action-buttons">
															<a class="green" href="editnilai.php?kn='.$datatbl["id"].'&&smt='.$smt.'&&kmp='.$kodemp.'">
																<i class="icon-pencil bigger-130"> </i> detail
															</a>
														</div>
														<div class="hidden-desktop visible-phone">
															<ul class="unstyled spaced">
																<li>
																	<a href="editnilai.php?kn='.$datatbl["id"].'&&smt='.$smt.'&&kmp='.$kodemp.'" class="tooltip-success" data-rel="tooltip" title="Detail">
																			<span class="green">
																				<i class="icon-pencil bigger-120"></i>
																			</span>
																	</a>
																</li>
															</ul>
														</div>
													</td>
												</tr>';
										    	}
											?>
											</tbody>
										</table>
									</div>
								<?php 
									echo '<form class="inline" action="laporannilai.php?smt='.$smt.'&&kmp='.$kodemp.'" method="POST">' 
								?>
								<button class="btn btn-small btn-primary">Laporan Excel</button>
							</form>
							<?php 
								echo '<form class="inline" action="laporanpdf.php?smt='.$smt.'&&kmp='.$kodemp.'" method="POST">' 
							?>
							<button class="btn btn-small btn-primary"">Laporan PDF </button>
						</form>
					<!--PAGE CONTENT ENDS-->
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

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110" title="kembali ke atas"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">
			$('.red').on('click', function(){
				return confirm('Update?\nPastikan jumlah bobot dari pengetahuan harus 100 dan keterampilan harus 100');
			});
			$('.save_j').on('click', function(){
				return confirm('Yakin Update Jumlah Tugas/UH untuk kelas ini?');
			});
			$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#tabel-mp').dataTable( {
				"aoColumns": [
			     null, null, null, null, null, null, null, null, null, null, null,
				{ "bSortable": false }				  
				] } );
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
					var off2 = $source.offset();
					var w2 = $source.width();
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
			})
				$('[data-rel=tooltip]').tooltip();
				$('[data-rel=popover]').popover({html:true});
		</script>
		<script type="text/javascript">
			$(function() {
				$('#loading-btn, #loading-btn2').on(ace.click_event, function () {
					var btn = $(this);
					btn.button('loading')
					setTimeout(function () {
						btn.button('reset')
					}, 6000)
				});
			})
		</script>		
	</body>
</html>