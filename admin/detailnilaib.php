<?php
	session_start();
	include '../config.php';
	$kode=$_GET['ks'];
	$smt=$_GET['smt'];

	if($_SESSION['status']!="administrator"){
		header("location:../loginadm.php");
	}

	if ($smt==01) {
		$kodesmt="Ganjil";
	}else{
		$kodesmt="Genap";
	}

	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilta=$datata['tahun_ajar'];

	$query="select * from siswa, kelas_siswa, kelas where siswa.kode_siswa=kelas_siswa.kode_siswa and kelas.kode_kelas=kelas_siswa.kode_kelas and siswa.kode_siswa='$kode'";
	$result=mysqli_query($koneksi,$query);
	$row=mysqli_fetch_array($result);
	$siswa=$row['nama_siswa'];
	$kk=$row['kode_kelas'];
	$kelas=$row['kelas'];
	$pem=$row['peminatan'];

	$queryk="select * from kehadiran where kode_siswa='$kode' and semester='$kodesmt'";
	$resultk=mysqli_query($koneksi,$queryk);
	$datak=mysqli_fetch_array($resultk);

	$querye="select * from kelas, kelas_siswa, ekskul, ekskul_siswa where kelas.kode_kelas=kelas_siswa.kode_kelas and kelas_siswa.kode_siswa=ekskul_siswa.kode_siswa and ekskul.kode_ekskul=ekskul_siswa.kode_ekskul and ekskul_siswa.kode_siswa='$kode'";
	$resulte=mysqli_query($koneksi,$querye);

	$querypra="select * from prakerin where kode_siswa='$kode'";
	$resultpra=mysqli_query($koneksi,$querypra);
	$datapra=mysqli_fetch_array($resultpra);

	$querypre="select * from prestasi where kode_siswa=$kode";
	$resultpre=mysqli_query($koneksi,$querypre);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIASMKBI - Administrator</title>
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
		<div id="modal" tabindex="-1" >
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left">
						<a href="penilaiankelas.php?<?php echo 'kk='.$kk.'&&smt='.$smt;?>" button class="btn btn-mini">
							<i class="icon-remove"></i>Kembali
						</a>
					 </span>
					Penilaian Lainnya 
					<?php 
						echo '<strong>'.$siswa.'</strong> | '.$kelas.' '.$pem.' | Semester '.$kodesmt.' '.$tampilta 
					?> 
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group" style="padding-left: 1%; padding-right: 1%">
					<div class="row-fluid">
						<div class="span6">
						<!--tabel kehadiran-->
							<div class="table-header header-color-dark" data-html="true" data-original-title="Jumlah kehadiran dalam satu semester." data-placement="bottom" data-rel="tooltip">
								Kehadiran
							</div>
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Hari Efektif</th>
										<th>Terlambat</th>
										<th>Sakit</th>
										<th>Izin</th>
										<th>Tanpa Keterangan</th>
									</tr>
								</thead>
								<tbody>
								<?php
						    		echo "<tr>
							    		<td>".$datak['hari_efektif']."</td>
							    		<td>".$datak['terlambat']."</td>
							    		<td>".$datak['sakit']."</td>
							    		<td>".$datak['izin']."</td>
							    		<td>".$datak['alpha']."</td>
						    		</tr>";
								?>
								</tbody>
							</table>
							<!--tabel ekskul-->
							<div class="table-header header-color-dark" data-html="true" data-original-title="Ekskul yang diambil selama menjadi siswa." data-placement="bottom" data-rel="tooltip">
								Ekskul
							</div>
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Kelas</th>
										<th>Nama Ekskul</th>
										<th>Nilai</th>
									</tr>
								</thead>
								<tbody>
								<?php
									while ($datae=mysqli_fetch_array($resulte)) {
										echo "<tr>
									    		<td>".$datae['kelas']." ".$datae['peminatan']."</td>
									    		<td>".$datae['nama_ekskul']."</td>
									    		<td>".$datae['nilai_ekskul']."</td>
									    	</tr>";
								   	}
							 	?>
								</tbody>
							</table>
						</div>
						<div class="span6">
						<!--tabel prakerin-->
							<div class="table-header header-color-dark" data-html="true" data-original-title="Data untuk siswa yang telah mengikuti prakerin." data-rel="tooltip">
								Prakerin
							</div>
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Tempat Praktek</th>
										<th>Alamat</th>
										<th>Nilai</th>
									</tr>
								</thead>
								<tbody>
								<?php
						    		echo "<tr>
							    		<td>".$datapra['tempat']."</td>
							    		<td>".$datapra['alamat']."</td>
							    		<td>".$datapra['nilai']."</td>
						    		</tr>";
								?>
								</tbody>
							</table>												
							<!--tabel prestasi-->
							<div class="table-header header-color-dark" data-html="true" data-original-title="Prestasi yang diraih selama menjadi siswa." data-rel="tooltip">
								Prestasi Siswa
							</div>
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Nama Prestasi</th>
										<th>Keterangan</th>
										
									</tr>
								</thead>
								<tbody>
								<?php
									while ($datapre=mysqli_fetch_array($resultpre)) {
							    		echo "<tr>
									    		<td>".$datapre['prestasi']."</td>
									    		<td>".$datapre['keterangan']."</td>
								    		</tr>";
									}
						    	?>
								</tbody>
							</table>												
						</div>
					</div>
				</div>
			</div>
		</div><!--/.main-content-->

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
				return confirm('Yakin Update Data?');
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
		</script>
	</body>
</html>