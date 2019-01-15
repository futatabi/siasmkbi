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
		$sikap="sikap_ga";
		$spiritual="spiritual_ga";
		$peng="peng_ga";
		$kete="kete_ga";
	}else{
		$kodesmt="Genap";
		$sikap="sikap_ge";
		$spiritual="spiritual_ge";
		$peng="peng_ge";
		$kete="kete_ge";
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
		<div id="modal" tabindex="-1">
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left">
						<a href="penilaiankelas.php?<?php echo 'kk='.$kk.'&&smt='.$smt;?>" button class="btn btn-mini">
							<i class="icon-remove"></i>Kembali
						</a>
					</span>
					<span>
						Penilaian Akademik <?php echo '<strong>'.$siswa.'</strong> | '.$kelas.' '.$pem.' | Semester '.$kodesmt.' '.$tampilta ?> 
					</span>
				</div>
			</div>
			<div class="container-fluid">
				<div class="control-group">
					<table id="tabel1" class="table table-striped table-bordered table-hover " style="padding-left: 1%; padding-right: 1%">
						<thead>
							<tr>
								<th>
									<abbr title="Mata Pelajaran" data-rel="tooltip" data-placement="bottom">MP</abbr>
								</th>
								<th>
									<abbr title="Nilai Kriteria Kelulusan Minimal" data-rel="tooltip" data-placement="bottom">KKM</abbr>
								</th>
								<th>
									<abbr title="Nilai Akhir Basis Pengetahuan. Nilai ini hasil gabungan Tugas, Ulangan Harian basis pengetahuan, UTS dan UAS dengan perbandingan bobot yang ditentukan guru mata pelajaran." data-rel="tooltip" data-placement="bottom">NA P</abbr>
								</th>
								<th>
									<abbr title="Nilai Akhir Basis Keterampilan. Nilai ini hasil gabungan Tugas dan Ulangan Harian basis keterampilan dengan perbandingan bobot yang ditentukan guru mata pelajaran." data-rel="tooltip" data-placement="bottom">NA K</abbr>
								</th>
								<th>
									<abbr title="Penilaian Sikap Siswa. Berdasarkan penilaian oleh guru mata pelajaran PKN atau Kewarganegaraan." data-rel="tooltip" data-placement="bottom">Sikap</abbr>
								</th>
								<th>
									<abbr title="Penilaian Spiritual Siswa. Berdasarkan penilaian oleh guru agama." data-rel="tooltip" data-placement="bottom">Spiritual</abbr>
								</th>
								<th>
									<abbr title="Deskripsi Pengetahuan Siswa." data-rel="tooltip" data-placement="bottom">Deskripsi P</abbr>
								</th>
								<th>
									<abbr title="Deskripsi Keterampilan Siswa." data-rel="tooltip" data-placement="bottom">Deskripsi K</abbr>
								</th>
							</tr>
						</thead>
						<tbody>
						<!--tabel-->
						<?php
						    include '../config.php';
						    $querytbl="select mpelajaran.kode_mp, mpelajaran.nama_mp, mpelajaran.kkm, nilai.* from mpelajaran, nilai where nilai.kode_siswa='$kode' and nilai.semester='$kodesmt' and nilai.kode_mp=mpelajaran.kode_mp";
					    	$resulttbl=mysqli_query($koneksi,$querytbl);
					    	while ($datatbl=mysqli_fetch_array($resulttbl)) {
					    		echo "<tr>
						    		<td>".$datatbl['nama_mp']."</td>
						    		<td>".$datatbl['kkm']."</td>
						    		<td>".$datatbl['nilai_peng']."</td>
						    		<td>".$datatbl['nilai_keter']."</td>
						    		<td>".$datatbl[$sikap]."</td>
						    		<td>".$datatbl[$spiritual]."</td>
						    		<td width=15%>".$datatbl[$peng]."</td>
						    		<td width=15%>".$datatbl[$kete]."</td>
					    		</tr>";
					    	}
					    ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--/.page-content-->

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