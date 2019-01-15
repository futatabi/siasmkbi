<?php
	session_start();
	include '../config.php';
	$ks=$_GET['ks'];
	$kk=$_GET['kk'];
	$kodesmt="Genap";
	if($_SESSION['status']!="walikelas"){
		header("location:../loginwali.php");
	}

	$user=$_SESSION['user'];
	$query="select * from walikelas where user_wali='$user'";
	$result=mysqli_query($koneksi,$query);
    while($data=mysqli_fetch_array($result)){
        $nama=$data['user_wali'];
        $kodekls=$data['kode_kelas'];
    }

	$querys="select nama_siswa from siswa where kode_siswa=$ks";
	$results=mysqli_query($koneksi,$querys);
	$datas=mysqli_fetch_array($results);
	$namas=$datas['nama_siswa'];

	$querykls="select kelas from kelas where kode_kelas='$kk'";
	$resultkls=mysqli_query($koneksi,$querykls);
	$datakls=mysqli_fetch_array($resultkls);
	$kls=$datakls['kelas'];
	// $querye="select * from ekskul, ekskul_siswa where ekskul.kode_ekskul=ekskul_siswa.kode_ekskul and ekskul_siswa.kode_siswa=$ks and ekskul_siswa.kode_kelas='$kodekls'";
	// $resulte=mysqli_query($querye);

	// $queryd="select deskripsi from nilai where kode_siswa=$ks and kode_kelas='$kodekls' and semester='$kodesmt'";
	// $resultd=mysqli_query($queryd);
	// $datad=mysqli_fetch_array($resultd);

	// $querypra="select * from prakerin where kode_siswa=$ks";
	// $resultpra=mysqli_query($querypra);
	// $datapra=mysqli_fetch_array($resultpra);

	// $querypre="select * from prestasi where kode_siswa=$ks";
	// $resultpre=mysqli_query($querypre);

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
	<!--edit -->
		<div id="modal" tabindex="-1">
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left"> &emsp;
						<a href="lihatkelas.php?<?php echo 'kk='.$kk.'&&smt=11'; ?>" <button class="btn btn-mini">
							<i class="icon-remove"></i>Kembali
						</a>
					</span>
					Keputusan Akhir <?php echo $namas ?>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12 table-header header-color-dark" data-original-title="Nilai Pengetahuan dan Keterampilan Siswa. Nilai yang dibawah KKM berwarna MERAH." data-placement="bottom" data-rel="tooltip">
						Nilai Akademik
					</div>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Mata Pelajaran</th>
							<th>KKM</th>
							<th>Nilai Pengetahuan</th>
							<th>Nilai Keterampilan</th>
						</tr>
						<?php
							$queryn="select * from siswa, nilai, mpelajaran where siswa.kode_siswa=nilai.kode_siswa and nilai.kode_mp=mpelajaran.kode_mp and siswa.kode_siswa='$ks' and semester='Genap'";
							$resultn=mysqli_query($koneksi,$queryn);
							// $resultk=mysqli_query($queryn);
							// $rowp=mysqli_num_rows($resultp);
							// $rowk=mysqli_num_rows($resultk);
							//P
							// $LP=0;
							while ($datan=mysqli_fetch_array($resultn)) {
								echo '<tr>
									<td>'.$datan['nama_mp'].'</td>
									<td>'.$datan['kkm'].'</td>';
								if ($datan['nilai_peng']<$datan['kkm']&&$datan['nilai_keter']<$datan['kkm']) {
									echo ' <td style="color:red">'.$datan['nilai_peng'].'</td>
										<td style="color:red">'.$datan['nilai_keter'].'</td>';
								}else if ($datan['nilai_peng']<$datan['kkm']) {
									echo ' <td style="color:red">'.$datan['nilai_peng'].'</td>
										<td>'.$datan['nilai_keter'].'</td>';
								}else if ($datan['nilai_keter']<$datan['kkm']) {
									echo ' <td>'.$datan['nilai_peng'].'</td>
										<td style="color:red">'.$datan['nilai_keter'].'</td>';
								}else{
									echo ' <td>'.$datan['nilai_peng'].'</td>
										<td>'.$datan['nilai_keter'].'</td>';
								}
								echo '</tr>';
							}
						?>
					</table>
					<!-- kehadiran						 -->
					<div class="row-fluid">
						<div class="span12 table-header header-color-dark" data-original-title="Jumlah Alpha yang melebihi 5% dari hari efektif berwarna MERAH." data-placement="bottom" data-rel="tooltip">
							Kehadiran Siswa
						</div>					
					</div>					
					<?php 
						$queryk="select * from kehadiran where kode_siswa='$ks' and kode_kelas='$kk' and semester='Genap'";
						$resultk=mysqli_query($koneksi,$queryk);
						$datak=mysqli_fetch_array($resultk);
						$e=$datak['hari_efektif'];
						$s=$datak['sakit'];
						$i=$datak['izin'];
						$a=$datak['alpha'];
						$h=$e-$s-$i-$a;
						if ($e==0) {
							$presh=0;
						}else{
							$presh=$h/$e*100;
						}
					?>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Presentase Kehadiran</th>
							<td><?php echo round($presh,2) ?> %</td>
						</tr>
						<tr>
							<th>Hari Efektif</th>
							<td><?php echo $e ?></td>
						</tr>
						<tr>
							<th>Tanpa keterangan</th>
							<?php
								if ($e==0) {
									$persena=0;
								}else{
									$persena=$a/$e;
								}
								if ($persena>=0.05) {
									echo'<td style="color:red">'.$a.'</td>';
								}else{
									echo'<td>'.$a.'</td>';
								}
							?>
						</tr>
					</table>
					<!-- eskul -->
					<div class="row-fluid">
						<div class="span12 table-header header-color-dark" data-original-title="Nilai Ekskul yang dibawah 70 (Cukup Baik) berwarna MERAH." data-placement="bottom" data-rel="tooltip">
							Ekstra Kurikuler
						</div>					
					</div>					
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Nama Ekskul</th>
							<th>Nilai</th>
						</tr>
						<tr>
							<?php 
								$querye="select * from ekskul, ekskul_siswa where ekskul.kode_ekskul=ekskul_siswa.kode_ekskul and kode_siswa='$ks' and kode_kelas='$kodekls'";
								$resulte=mysqli_query($koneksi,$querye);
								while($datae=mysqli_fetch_array($resulte)){
									if ($datae['nilai_ekskul']=='') {
										echo '<td style="color:red">tidak ada ekskul yang diikuti</td>
											<td style="color:red">tidak ada nilai</td>';
									}else if ($datae['nilai_ekskul']>70) {
										echo '<td>'.$datae['nama_ekskul'].'</td>
											<td>'.$datae['nilai_ekskul'].'</td>';
									}else{
										echo '<td style="color:red">'.$datae['nama_ekskul'].'</td>
										<td style="color:red">'.$datae['nilai_ekskul'].'</td>';
									}
								}
							?>
						</tr>
					</table>
					<?php
						if ($kls=='XI'||$kls=='XI-1'||$kls=='XI-2'||$kls=='XI-3'||$kls=='XII'||$kls=='XII-1'||$kls=='XII-2'||$kls=='XII-3') {
					?>
					<!-- prakerin						 -->
					<div class="row-fluid">
						<div class="span12 table-header header-color-dark" data-original-title="Nilai Prakerin yang dibawah 70 (Cukup Baik) berwarna MERAH." data-placement="bottom" data-rel="tooltip">
							Prakerin
						</div>					
					</div>					
					<?php 
						$querypra="select * from prakerin where kode_siswa='$ks'";
						$resultpra=mysqli_query($koneksi,$querypra);
						$datapra=mysqli_fetch_array($resultpra);
						$t=$datapra['tempat'];
						$n=$datapra['nilai'];
					?>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Tempat Prakertin</th>
							<td><?php echo $t ?></td>
						</tr>
						<tr>
							<th>Nilai</th>
							<?php
								if ($n>=70) {
									echo'<td>'.$n.'</td>';
								}else{
									echo'<td style="color:red">'.$n.'</td>';
								}
							?>
						</tr>
					</table>
					<?php
						}
					?>
					<!-- prestasi -->
					<div class="row-fluid">
						<div class="span12 table-header header-color-dark" data-original-title="Prestasi yang diraih siswa di kelas ini." data-placement="bottom" data-rel="tooltip">
							Prestasi Siswa
						</div>					
					</div>					
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Nama Prestasi</th>
							<th>Keterangan</th>
						</tr>
						<tr>
							<?php 
								$querypre="select * from prestasi where kode_siswa='$ks' and kode_kelas='$kodekls'";
								$resultpre=mysqli_query($koneksi,$querypre);
								$rowpre=mysqli_num_rows($resultpre);
								if ($rowpre>0) {
									while($datapre=mysqli_fetch_array($resultpre)){
										echo '<td>'.$datapre['prestasi'].'</td>
											<td>'.$datapre['keterangan'].'</td>';
									}
								}else{
									echo '<td style="color:red">belum ada</td>
										<td style="color:red">-</td>';
								}
							?>
						</tr>
					</table>
				<!--/.page-content-->
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
			$('.save').on('click', function(){
				return confirm('Yakin Update Data?\nPastikan jumlah hari sakit, izin, tanpa keterangan, dan terlambat pada data kehadiran tidak melebihi jumlah hari efektif');
				$('#accordion2').on('hide', function (e) {
					$(e.target).prev().children(0).addClass('collapsed');
				})
				$('#accordion2').on('hidden', function (e) {
					$(e.target).prev().children(0).addClass('collapsed');
				})
				$('#accordion2').on('show', function (e) {
					$(e.target).prev().children(0).removeClass('collapsed');
				})
				$('#accordion2').on('shown', function (e) {
					$(e.target).prev().children(0).removeClass('collapsed');
				})
			});
			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});
			$('.saveeks').on('click', function(){
				return confirm('Tambah?\nPastikan tidak ada nama ekskul yang duplikat');
			});
			$('.red').on('click', function(){
				return confirm('Yakin hapus?');
			});
		</script>
	</body>
</html>