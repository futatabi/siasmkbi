<?php
	session_start();
	include '../config.php';
	$kodekls=$_GET['kk'];
	$smt=$_GET['smt'];
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

	$query2="select * from kelas where kode_kelas='$kodekls'";
	$result2=mysqli_query($koneksi,$query2);
	$datakls=mysqli_fetch_array($result2);
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
									<?php echo $nama ?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../logoutwali.php" title="keluar dari akun ini" class="logout">
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
					<li class="active open">
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
									<?php
										if ($smt==01) {
										echo '<li class="active">
											<a href="lihatkelas.php?kk='.$kelas.'&&smt=01">
												<i class="icon-adjust"></i>
												Semester Ganjil
											</a>
										</li>
										<li>
											<a href="lihatkelas.php?kk='.$kelas.'&&smt=11">
												<i class="icon-circle"></i>
												Semester Genap
											</a>
										</li>';
										}else{
											echo '<li>
												<a href="lihatkelas.php?kk='.$kelas.'&&smt=01">
													<i class="icon-adjust"></i>Semester Ganjil
												</a>
											</li>
											<li class="active">
												<a href="lihatkelas.php?kk='.$kelas.'&&smt=11">
													<i class="icon-circle"></i>Semester Genap
												</a>
											</li>';
										}
									?>
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
												if ($smt==01) {
													$kodesmt="Ganjil";
													$ujian="UTS";
													$nujian="uts";
													
												}else{
													$kodesmt="Genap";
													$ujian="UAS";
													$nujian="uas";
													
												}
												echo "<b>Semester : </b>".$kodesmt;
											?>
										</div>
									</form>		
								</div>
								<?php 
									if ($smt==01) {							 		
										echo '<table id="tabel-mp" class="table table-striped table-bordered table-hover">';
									}else{
										echo '<table id="tabel-mp2" class="table table-striped table-bordered table-hover">';
									}
								?>
								<thead>
									<tr>
										<th>
											<abbr title="Nama Siswa" data-rel="tooltip">Nama</abbr>
										</th>
										<th>
											<abbr title="Jenis Kelamin" data-rel="tooltip">JK</abbr>
										</th>
										<th>
											<abbr title="Jumlah hari kehadiran dalam satu semester" data-rel="tooltip">Kehadiran</abbr>
										</th>
										<th>
											<abbr title="Jumlah ekskul yang diikuti siswa" data-rel="tooltip">Ekskul</abbr>
										</th>
										<th>
											<abbr title="Status prakerin siswa" data-rel="tooltip">Prakerin</abbr>
										</th>
										<th></th>
										<?php
											if ($smt==11) {
												echo '<th><abbr title="Keputusan Kenaikan Kelas. Keputusan ini hanya prediksi semata, keputusan sebenarnya ditentukan oleh rapat kenaikan kelas" data-rel="tooltip">Keputusan</abbr></th>';
											}
										?>
									</tr>
								</thead>
								<tbody>
									<tr>
									<!--tabel-->
									<?php
									    include '../config.php';
										$querytbl="select siswa.kode_siswa, siswa.nama_siswa, siswa.jk, kelas_siswa.kode_siswa, kelas_siswa.kode_kelas, kehadiran.kode_siswa, kehadiran.*, ekskul.kode_ekskul, ekskul.nama_ekskul, ekskul_siswa.kode_ekskul, ekskul_siswa.kode_siswa, ekskul_siswa.kode_kelas, prakerin.kode_siswa, prakerin.kode_siswa, prakerin.tempat, COUNT(ekskul_siswa.kode_kelas) FROM siswa, kelas_siswa, kehadiran, ekskul, ekskul_siswa, prakerin WHERE siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=kehadiran.kode_siswa and siswa.kode_siswa=ekskul_siswa.kode_siswa and siswa.kode_siswa=prakerin.kode_siswa and kelas_siswa.kode_kelas=kehadiran.kode_kelas and kelas_siswa.kode_kelas=ekskul_siswa.kode_kelas and kelas_siswa.kode_kelas=prakerin.kode_kelas and kelas_siswa.kode_kelas=$kodekls and kehadiran.semester='$kodesmt' and ekskul.kode_ekskul=ekskul_siswa.kode_ekskul GROUP BY siswa.kode_siswa order by siswa.nama_siswa";
										   	$resulttbl=mysqli_query($koneksi,$querytbl);
											//$querysiswa="select * from siswa, kelas_siswa where siswa.kode_siswa=kelas_siswa.kode_siswa=$kodekls";
										    //$resultsiswa=mysqli_query($koneksi,$querysiswa);
										    while ($datatbl=mysqli_fetch_array($resulttbl)) {
										    	$hadir=$datatbl['hari_efektif']-$datatbl['sakit']-$datatbl['izin']-$alpha=$datatbl['alpha'];
										    	$harie=$datatbl['hari_efektif'];
										    	echo "<td>".$datatbl['nama_siswa']."</td>
										    		<td>".$datatbl['jk']."</td>
										    		<td>".$hadir." dari ".$harie."</td>
										    		<td>".$datatbl['COUNT(ekskul_siswa.kode_kelas)']." ekskul</td>
										    		<td>";
										    	if ($datatbl['tempat']=='') {
										    	 	echo "belum";
										    	}else{
										    	 	echo "sudah";
										    	};
										    	echo "</td>";
										    	echo '<td class="td-actions">
													<div class="hidden-phone visible-desktop action-buttons">
														<a class="green" href="editnilai.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'">
															<i class="icon-pencil bigger-130"> </i> edit
														</a>
													</div>
													<div class="hidden-desktop visible-phone">
														<ul class="unstyled spaced">
															<li>
																<a href="editnilai.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'" class="tooltip-success" data-rel="tooltip" title="Edit">
																	<span class="green">
																		<i class="icon-pencil bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</td>';
												if ($smt==11) {
													$ks=$datatbl["kode_siswa"];
													$queryn="select * from siswa, nilai, mpelajaran where siswa.kode_siswa=nilai.kode_siswa and nilai.kode_mp=mpelajaran.kode_mp and siswa.kode_siswa='$ks' and semester='Genap'";
													$resultp=mysqli_query($koneksi,$queryn);
													$resultk=mysqli_query($koneksi,$queryn);
													$rowp=mysqli_num_rows($resultp);
													$rowk=mysqli_num_rows($resultk);
													//P
													$LP=0;
													while ($datan=mysqli_fetch_array($resultp)) {
														$kkm=$datan['kkm'];
														$p=$datan['nilai_peng'];
														//	$k=$datan['nilai_keter'];
														if ($p>=$kkm) {
															$LP++;
														}else{
															$LP=$LP;
														}
													}
													// echo $LP;
													// echo $rowp;
													//K
													$LK=0;
													while ($datan=mysqli_fetch_array($resultk)) {
														$kkm=$datan['kkm'];
														$k=$datan['nilai_keter'];
														if ($k>=$kkm) {
															$LK++;
														}else{
															$LK=$LK;
														}
													}
													// echo $LK;
													// echo $rowk;
													//kehadiran
													if ($harie==0) {
														$persena=0;
													}else{
														$persena=$alpha/$harie;
													}
													if ($persena>=0.05) {
														$LKE=0;
													}else{
														$LKE=1;
													}
													// echo $LKE;
													//ekskul
													$querye="select avg(nilai_ekskul) as avge from ekskul_siswa where kode_siswa='$ks' and kode_kelas='$kodekls'";
													$resulte=mysqli_query($koneksi,$querye);
													$datae=mysqli_fetch_array($resulte);
													if ($datae['avge']=='') {
														$LE=0;
													}else if ($datae['avge']>70) {
														$LE=1;
													}else{
														$LE=0;
													}
													//prakerin
													$queryp="select nilai from prakerin where kode_siswa='$ks'";
													$resultp=mysqli_query($koneksi,$queryp);
													$datap=mysqli_fetch_array($resultp);
													if ($datap['nilai']>70) {
														$LPR=1;
													}else{
														$LPR=0;
													}
													// $LPR;
													//prestasi
													$querypre="select * from prestasi where kode_siswa='$ks' and kode_kelas='$kodekls'";
													$resultpre=mysqli_query($koneksi,$querypre);
													$rowpre=mysqli_num_rows($resultpre);
													//keputusan 
													$keppk=$rowp+$rowk-2;
													$hasilpk=$LP+$LK;
													$kepna=1+1+1+$rowpre;
													$hasilna=$LKE+$LE+$LPR+$rowpre;
													if ($keppk<=$hasilpk) {
														if ($kepna>=$hasilna) {
															echo '<td class="action-buttons"><a href="keputusan.php?kk='.$kodekls.'&ks='.$ks.'"><i class="icon-arrow-up bigger-120"></i> Naik Kelas</a></td>';
														}else{
															echo '<td class="action-buttons"><a href="keputusan.php?kk='.$kodekls.'&ks='.$ks.'" class="red"><i class="icon-arrow-down bigger-120"></i> Tinggal Kelas</a></td>';	
														}
													}else{	
														echo '<td class="action-buttons"><a href="keputusan.php?kk='.$kodekls.'&ks='.$ks.'" class="red"><i class="icon-arrow-down bigger-120"></i> Tinggal Kelas</a></td>';
													}
												}
												echo '</tr>';
											}
									?>
								</tbody>
							</table>
						</div>
						<!--PAGE CONTENT ENDS-->
					</div><!--/.span-->
				</div><!--/.row-fluid-->

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
			$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#tabel-mp').dataTable( {
				"aoColumns": [
			     null, null, null, null, null,
				{ "bSortable": false }
				] } );
				var oTable1 = $('#tabel-mp2').dataTable( {
				"aoColumns": [
			     null, null, null, null, null,
				{ "bSortable": false }, null
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
	</body>
</html>