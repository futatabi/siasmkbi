<?php
	session_start();
	include '../config.php';
	$kode=$_GET['kn'];
	$smt=$_GET['smt'];
	$kodemp=$_GET['kmp'];
	if($_SESSION['status']!="gurump"){
		header("location:../loginguru.php");
	}

	if ($smt==01) {
		$kodesmt="Ganjil";
		$desp="peng_ga";
		$desk="kete_ga";	
		$bobottgsp="bobot_tgsp_ga";
		$bobotuhp="bobot_uhp_ga";
		$bobottgsk="bobot_tgsk_ga";
		$bobotuhk="bobot_uhk_ga";
		$bobotuts="bobot_uts_ga";
		$bobotuas="bobot_uas_ga";
		$sikap="sikap_ga";
		$spiritual="spiritual_ga";
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
		$desp="peng_ge";
		$desk="kete_ge";
		$bobottgsp="bobot_tgsp_ge";
		$bobotuhp="bobot_uhp_ge";
		$bobottgsk="bobot_tgsk_ge";
		$bobotuhk="bobot_uhk_ge";
		$bobotuts="bobot_uts_ge";
		$bobotuas="bobot_uas_ge";
		$sikap="sikap_ge";
		$spiritual="spiritual_ge";
		$deskpa="peng_ge_a";
		$deskpb="peng_ge_b";
		$deskpc="peng_ge_c";
		$deskpd="peng_ge_d";
		$deskka="kete_ge_a";
		$deskkb="kete_ge_b";
		$deskkc="kete_ge_c";
		$deskkd="kete_ge_d";
	}
	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilta=$datata['tahun_ajar'];

	$query="select * from siswa, nilai where nilai.id='$kode' and siswa.kode_siswa=nilai.kode_siswa and nilai.semester='$kodesmt'";
	$result=mysqli_query($koneksi,$query);
	$result2=mysqli_query($koneksi,$query);//tgs p
	$result3=mysqli_query($koneksi,$query);//uh p
	$result4=mysqli_query($koneksi,$query);//tgs k
	$result5=mysqli_query($koneksi,$query);//uh k
	$row=mysqli_fetch_array($result);

	$siswa=$row['nama_siswa'];
	$uts=$row['uts'];
	$uas=$row['uas'];
	$kg=$row['kode_guru'];

	//bobot desk
	$queryb="select * from mpelajaran where mpelajaran.kode_mp='$kodemp'";
	$resultb=mysqli_query($koneksi,$queryb);
	$datab=mysqli_fetch_array($resultb);
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
	<!--edit -->
	<div id="modal" tabindex="-1">
		<div class="modal-header center no-padding">
			<div class="table-header">
				<span class="pull-left"> &emsp;
					<a href="lihatkelas.php?<?php echo 'kmp='.$kodemp.'&&smt='.$smt;?>" button class="btn btn-mini">
						<i class="icon-remove"></i>Kembali
					</a>
				</span>
				Detail Penilaian 
				<strong><?php echo $siswa ?></strong>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row-fluid" >
				<form method="post" action="#" class="form-inline" style="padding-left: 1%; padding-right: 1%"> 
					<h3 class="header smaller lighter blue">
					Penilaian Basis Pengetahuan
					</h3>			
					<div class="row-fluid">
						<div class="grid2">
							<table id="tabel" class="table inline table-striped table-bordered table-hover ">
							<?php
							//pengetahuan
								$i=1;
								$jumlahtgsp=$row['jum_tgs_peng'];
								if ($jumlahtgsp==0) {
									echo '<tr><th>Tidak ada tugas yang dilakukan. Untuk menambahkan, isi jumlah tugas/UH di halaman sebelumnya.</th></tr>';
								}else{
									while ($data1=mysqli_fetch_array($result2)) {
								 		while ($i<=$jumlahtgsp) {									
											echo '<tr>
												<th>Tugas '.$i.'</th>
												<th><input class="input-small" type="number" step="0.01" min="0" max="100"  name="tgsp'.$i.'" value="'.$data1['tgs_peng'.$i.''].'" /></th>
											</tr>';
											$i++;
										}
									}
								}
								echo '<div class="table-header header-color-dark form-inline">Nilai Penugasan</div>
									Jumlah Tugas yang dilakukan = '.$jumlahtgsp.'&emsp;&emsp;';
								echo 'Rerata Nilai Tugas = '.$row['rerata_tgs_peng'];
							?>	
							</table>
						</div>
						<div class="grid2">
							<table id="tabel" class="table inline table-striped table-bordered table-hover ">
							<?php
							//uh peng
								$i=1;
								$jumlahuhp=$row['jum_uh_peng'];
								if ($jumlahuhp==0) {
									echo '<tr><th>Tidak ada UH yang dilakukan. Untuk menambahkan, isi jumlah tugas/UH di halaman sebelumnya.</th></tr>';
								}else{
								 	while ($data1=mysqli_fetch_array($result3)) {
								 		while ($i<=$jumlahuhp) {									
											echo '<tr>
												<th>UH '.$i.'</th>
												<th><input class="input-small" type="number" step="0.01" min="0" max="100" name="uhp'.$i.'" value="'.$data1['uh_peng'.$i.''].'" /></th>
											</tr>';
											$i++;
										}
									}
								}
								echo '<div class="table-header header-color-dark form-inline">Nilai Ulangan Harian</div>
									Jumlah UH yang dilakukan = '.$jumlahuhp.'&emsp;&emsp;';
								echo 'Rerata Nilai UH = '.$row['rerata_uh_peng'];
							?>	
							</table>
						</div>	
					</div>
					<h3 class="header smaller lighter blue">
						Penilaian Basis Keterampilan
					</h3>									
					<div class="clearfix">
						<div class="grid2">
							<table id="tabel" class="table table-striped table-bordered table-hover inline">
							<?php
							//keterampilan
								$i=1;
								$jumlahtgsk=$row['jum_tgs_keter'];
								if ($jumlahtgsk==0) {
									echo '<tr><th>Tidak ada tugas yang dilakukan. Untuk menambahkan, isi jumlah tugas/UH di halaman sebelumnya.</th></tr>';
								}else{
									while ($data1=mysqli_fetch_array($result4)) {
								 		while ($i<=$jumlahtgsk) {							
											echo '<tr>
												<th>Tugas '.$i.'</th>
												<th><input class="input-small" type="number" step="0.01" minlength="1" min="0" max="100" name="tgsk'.$i.'" value="'.$data1['tgs_keter'.$i.''].'" />
												</th>
											</tr>';
											$i++;
										}
									}
								}
								echo '<div class="table-header header-color-dark form-inline">Nilai Penugasan</div>
								Jumlah Tugas yang dilakukan = '.$jumlahtgsk.'&emsp;&emsp;';
								echo 'Rerata Nilai Tugas = '.$row['rerata_tgs_keter'];
							?>					
							</table>
						</div>
						<div class="grid2">
							<table id="tabel" class="table inline table-striped table-bordered table-hover ">
							<?php
							//uh keter
								$i=1;
								$jumlahuhk=$row['jum_uh_keter'];
								if ($jumlahuhk==0) {
									echo '<tr><th>Tidak ada UH yang dilakukan. Untuk menambahkan, isi jumlah tugas/UH di halaman sebelumnya.</th></tr>';
								}else{
								 	while ($data1=mysqli_fetch_array($result5)) {
								 		while ($i<=$jumlahuhk) {									
											echo '<tr>
												<th>UH '.$i.'</th>
												<th><input class="input-small" type="number" step="0.01" min="0" max="100" name="uhk'.$i.'" value="'.$data1['uh_keter'.$i.''].'" /></th>
											</tr>';
											$i++;
										}
									}
								}
								echo '<div class="table-header header-color-dark form-inline">Nilai Ulangan Harian</div>
								Jumlah UH yang dilakukan = '.$jumlahuhk.'&emsp;&emsp;';
								echo 'Rerata Nilai UH = '.$row['rerata_uh_keter'];
							?>	
							</table>
						</div>
					</div>
					<?php	
					//sikap spiritual
						$namamp=$datab['nama_mp'];
						if ($namamp=='PKN'||$namamp=='Kewarganegaraan') {
							include 'sikap.php';
						}else if ($namamp=='Pendidikan Agama Islam'||$namamp=='Pendidikan Agama Kristen'||$namamp=='Pendidikan Agama Katolik'||$namamp=='Pendidikan Agama Hindu'||$namamp=='Pendidikan Agama Buddha'||$namamp=='Pendidikan Agama Kong Hu Cu') {
							include 'spiritual.php';
						}else{
						}
					?>
					<h3 class="header smaller lighter blue">
						Penilaian Akhir
					</h3>
					<div class="clearfix">
						<div class="grid3">
							<div class="table-header header-color-dark form-inline">UTS</div>
							<input class="input-small" type="number" step="0.01" min="0" max="100" name="uts" value="<?php echo $row['uts'];?>" />
						</div>
						<div class="grid3">
							<div class="table-header header-color-dark form-inline">UAS</div>
							<input class="input-small" type="number" step="0.01" min="0" max="100" name="uas" value="<?php echo $row['uas'];?>" />
						</div>					
						<div class="grid3">
							<br>
							<button class="btn btn-small btn-primary save" type="submit" name="submit" value="submit">
								<i class="icon-ok"></i>Simpan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--masukan -->				
		<?php
			if(isset($_POST['submit'])){
			//post
				$i=1;
				while ($i<=$jumlahtgsp) {
					${"tgsp$i"}=$_POST['tgsp'.$i.''];
					$i++;	
				}
				$i=1;
				while ($i<=$jumlahuhp) {
					${"uhp$i"}=$_POST['uhp'.$i.''];	
					$i++;
				}
				$i=1;
				while ($i<=$jumlahtgsk) {
					${"tgsk$i"}=$_POST['tgsk'.$i.''];	
					$i++;
				}
				$i=1;
				while ($i<=$jumlahuhk) {
					${"uhk$i"}=$_POST['uhk'.$i.''];	
					$i++;
				}
				$uts=$_POST['uts'];
				$uas=$_POST['uas'];
				$deskripsip=$_POST['dessmtp'];
				$deskripsik=$_POST['dessmtk'];

			//reratatgsp
				$i=1;
				if ($jumlahtgsp>0) {
					while ($i<=$jumlahtgsp) {
						$jtgsp[$i-1]=$_POST['tgsp'.$i.''];
						$i++;
					}
					$rtgsp=array_sum($jtgsp)/$jumlahtgsp;
				}else{
					$rtgsp=0;
				}
			//reratauhp
				$i=1;
				if ($jumlahuhp>0) {
					while ($i<=$jumlahuhp) {
						$juhp[$i-1]=$_POST['uhp'.$i.''];
						$i++;
					}
					$ruhp=array_sum($juhp)/$jumlahuhp;
				}else{
					$ruhp=0;
				}
			//reratatgsk
				$i=1;
				if ($jumlahtgsk>0) {
					while ($i<=$jumlahtgsk) {
						$jtgsk[$i-1]=$_POST['tgsk'.$i.''];
						$i++;
					}
					$rtgsk=array_sum($jtgsk)/$jumlahtgsk;
				}else{
					$rtgsk=0;
				}
			//reratauhk
				$i=1;
				if ($jumlahuhk>0) {
					while ($i<=$jumlahuhk) {
						$juhk[$i-1]=$_POST['uhk'.$i.''];
						$i++;
					}
					$ruhk=array_sum($juhk)/$jumlahuhk;
				}else{
					$ruhk=0;
				}
			//NA
				$btgsp=$datab[$bobottgsp];
				$buhp=$datab[$bobotuhp];
				$btgsk=$datab[$bobottgsk];
				$buhk=$datab[$bobotuhk];
				$buts=$datab[$bobotuts];
				$buas=$datab[$bobotuas];
				$penga=$datab[$deskpa];
				$pengb=$datab[$deskpb];
				$pengc=$datab[$deskpc];
				$pengd=$datab[$deskpd];
				$ketea=$datab[$deskka];
				$keteb=$datab[$deskkb];
				$ketec=$datab[$deskkc];
				$keted=$datab[$deskkd];

				$np=($btgsp*$rtgsp/100)+($buhp*$ruhp/100)+($buts*$uts/100)+($buas*$uas/100);
				$nk=($btgsk*$rtgsk/100)+($buhk*$ruhk/100);

				if ($np>85&&$np<=100) {
						$deskripsip="$penga";
					}else if ($np>70&&$np<=85) {
						$deskripsip="$pengb";
					}else if ($np>55&&$np<=70) {
						$deskripsip="$pengc";
					}else if ($np<=55){
						$deskripsip="$pengd";
					}
				if ($nk>85&&$nk<=100) {
						$deskripsik="$ketea";
					}else if ($nk>70&&$nk<=85) {
						$deskripsik="$keteb";
					}else if ($nk>55&&$nk<=70) {
						$deskripsik="$ketec";
					}else if ($nk<=55){
						$deskripsik="$keted";
					}
				$query1="update nilai set tgs_peng1='$tgsp1', tgs_peng2='$tgsp2', tgs_peng3='$tgsp3', tgs_peng4='$tgsp4', tgs_peng5='$tgsp5', tgs_peng6='$tgsp6', tgs_peng7='$tgsp7', tgs_peng8='$tgsp8', tgs_peng9='$tgsp9', tgs_peng10='$tgsp10', uh_peng1='$uhp1', uh_peng2='$uhp2', uh_peng3='$uhp3', uh_peng4='$uhp4', uh_peng5='$uhp5', uh_peng6='$uhp6', tgs_keter1='$tgsk1', tgs_keter2='$tgsk2', tgs_keter3='$tgsk3', tgs_keter4='$tgsk4', tgs_keter5='$tgsk5', tgs_keter6='$tgsk6', tgs_keter7='$tgsk7', tgs_keter8='$tgsk8', tgs_keter9='$tgsk9', tgs_keter10='$tgsk10', uh_keter1='$uhk1', uh_keter2='$uhk2', uh_keter3='$uhk3', uh_keter4='$uhk4', uh_keter5='$uhk5', uh_keter6='$uhk6', uts='$uts', uas='$uas', $desp='$deskripsip', $desk='$deskripsik', rerata_tgs_peng='$rtgsp', rerata_uh_peng='$ruhp', rerata_tgs_keter='$rtgsk', rerata_uh_keter='$ruhk', nilai_peng='$np', nilai_keter='$nk' where id='$kode'";
				$result1=mysqli_query($koneksi,$query1);
			//sikap spiritual query
				if ($namamp=='PKN'||$namamp=='Kewarganegaraan') {
					include 'qsikap.php';
				}else if ($namamp=='Pendidikan Agama Islam'||$namamp=='Pendidikan Agama Kristen'||$namamp=='Pendidikan Agama Katolik'||$namamp=='Pendidikan Agama Hindu'||$namamp=='Pendidikan Agama Buddha'||$namamp=='Pendidikan Agama Kong Hu Cu') {
					include 'qspiritual.php';
				}

				if($result1){
					echo "<script type='text/javascript'>alert('Berhasil update')</script>";
					echo "<meta http-equiv='refresh' content='0'>";
				}else{
					echo "<script type='text/javascript'>alert('Gagal')</script>";
				}
			}
		?>
		</div><!--/.page-content-->
				
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
		</script>
	</body>
</html>