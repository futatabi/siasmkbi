<?php
	session_start();
	include '../config.php';
	$kode=$_GET['ks'];
	$smt=$_GET['smt'];
	if($_SESSION['status']!="walikelas"){
		header("location:../loginwali.php");
	}

	if ($smt==01) {
		$kodesmt="Ganjil";
	}else{
		$kodesmt="Genap";
	}

	$user=$_SESSION['user'];
	$query="select * from walikelas where user_wali='$user'";
	$result=mysqli_query($koneksi,$query);
    while($data=mysqli_fetch_array($result)){
        $nama=$data['user_wali'];
        $kodekls=$data['kode_kelas'];
    }

	$querys="select nama_siswa from siswa where kode_siswa=$kode";
	$results=mysqli_query($koneksi,$querys);
	$datas=mysqli_fetch_array($results);
	$namas=$datas['nama_siswa'];

	$queryk="select * from kehadiran where kode_siswa=$kode and semester='$kodesmt'";
	$resultk=mysqli_query($koneksi,$queryk);
	$datak=mysqli_fetch_array($resultk);

	$querye="select * from ekskul, ekskul_siswa where ekskul.kode_ekskul=ekskul_siswa.kode_ekskul and ekskul_siswa.kode_siswa=$kode and ekskul_siswa.kode_kelas='$kodekls'";
	$resulte=mysqli_query($koneksi,$querye);

	$queryd="select deskripsi from nilai where kode_siswa=$kode and kode_kelas='$kodekls' and semester='$kodesmt'";
	$resultd=mysqli_query($koneksi,$queryd);
	$datad=mysqli_fetch_array($resultd);

	$querypra="select * from prakerin where kode_siswa=$kode";
	$resultpra=mysqli_query($koneksi,$querypra);
	$datapra=mysqli_fetch_array($resultpra);

	$querypre="select * from prestasi where kode_siswa=$kode";
	$resultpre=mysqli_query($koneksi,$querypre);
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
						<a href="lihatkelas.php?<?php echo 'kk='.$kodekls.'&&smt='.$smt;?>" button class="btn btn-mini">
							<i class="icon-remove"></i>Kembali
						</a>
					</span>
					Detail Penilaian <?php echo $namas ?>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<form method="post" action="#" class="form-inline" style="padding-left: 1%; padding-right: 1%"> 
						<div class="row-fluid">
							<div class="span6">
								<div class="table-header header-color-dark" data-html="true" data-original-title="Jumlah kehadiran dalam satu semester. <br>Input berupa angka (jumlah hari, maksimal 185). <br>Jumlah hari sakit, izin, tanpa keterangan, dan terlambat tidak boleh melebihi jumlah hari efektif." data-placement="bottom" data-rel="tooltip">
									Kehadiran
								</div>
								<table id="tabel" class="table table-striped table-bordered table-hover inline">
									<tr>
										<th>
											<label>Jumlah hari efektif</label>
										</th>
										<th>
											<input class="input-mini" required="required" type="number" min="0" max="185" name="h_efektif" value="<?php echo $datak['hari_efektif'] ?>"  />
										</th>
									</tr>
									<tr>
										<th>
											<label>Sakit</label>
										</th>
										<th>
											<input class="input-mini" required="required" type="number" min="0" max="185" name="sakit" value="<?php echo $datak['sakit'] ?>" />
										</th>
									</tr>
									<tr>
										<th>
											<label>Izin</label>
										</th>
										<th>
											<input class="input-mini" required="required" type="number" min="0" max="185" name="izin" value="<?php echo $datak['izin'] ?>" />
										</th>
									</tr>							
									<tr>
										<th>
											<label>Tanpa Keterangan</label>
										</th>
										<th>
											<input class="input-mini" type="number" required="required" min="0" max="185" name="alpha" value="<?php echo $datak['alpha'] ?>" />
										</th>
									</tr>					
									<tr>
										<th>
											<label>Terlambat</label>&emsp;
										</th>
										<th>
											<input class="input-mini" type="number" min="0" required="required" max="185" name="terlambat" value="<?php echo $datak['terlambat'] ?>" />
										</th>
									</tr>
								</table>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<div class="span12 table-header header-color-dark" data-original-title="Ekskul yang diambil siswa dalam satu tahun ajaran. Ekskul dapat lebih dari satu" data-placement="bottom" data-rel="tooltip">
										<div class="row-fluid">
											<div class="span6">
												Ekskul
											</div>
											<div class="span2 pull-right">
												<a href="#modal-tambah" role="button"  data-toggle="modal">
													<button onclick="return false;" class="btn btn-mini btn-primary" title="tambah data ekskul">
														<i class="icon-plus"></i>Tambah
													</button>
												</a>
											</div>
										</div>
									</div>
									<table class="table table-bordered table-hover inline">
										<tr>
											<th>
												<label>Nama Ekskul</label>
											</th>
											<th>
												<label>Nilai</label>
											</th>
											<th></th>
										</tr>
										<?php
											while ($datae=mysqli_fetch_array($resulte)) {
												echo '<tr>
														<td>
															'.$datae['nama_ekskul'].'
														</td>
														<td>
															'.$datae['nilai_ekskul'].'
														</td>';
										    	echo '<td>
														<div class="action-buttons">
															<a class="green" href="editekskul.php?id='.$datae['id'].'&&ks='.$kode.'&&smt='.$smt.'" >
																<i class="icon-pencil bigger-130"> </i> edit
															</a>
															<a class="red" href="hapusekskul.php?id='.$datae['id'].'&&ks='.$kode.'&&smt='.$smt.'">
																<i class="icon-trash bigger-130"> </i> hapus
															</a>
														</div>
													</td>
												</tr>';
											}
										?>									
									</table>
								</div>
								<div class="row-fluid">
									<div class="span12 table-header header-color-dark" data-original-title="Prestasi yang diraih selama menjadi siswa. Prestasi dapat lebih dari satu." data-placement="bottom" data-rel="tooltip">
										<div class="row-fluid">
											<div class="span6">
												Prestasi
											</div>
											<div class="span2 pull-right">
												<a href="#modal-tambahpre" role="button"  data-toggle="modal">
													<button onclick="return false;" class="btn btn-mini btn-primary" title="tambah data prestasi">
														<i class="icon-plus"></i>Tambah
													</button>
												</a>
											</div>
										</div>
									</div>
									<table id="tabel" class="table table-bordered table-hover inline">
										<tr>
											<th>
												<label>Nama Prestasi</label>
											</th>
											<th></th>
										</tr>
										<?php
											while ($datapre=mysqli_fetch_array($resultpre)) {
												echo '<tr>
														<td>
															'.$datapre['prestasi'].'
														</td>';
										    	echo '<td>
														<div class="action-buttons">
															<a class="green" href="editpre.php?id='.$datapre['id'].'&&ks='.$kode.'&&smt='.$smt.'" >
																<i class="icon-pencil bigger-130"> </i> detail
															</a>
															<a class="red" href="hapuspre.php?id='.$datapre['id'].'&&ks='.$kode.'&&smt='.$smt.'">
																<i class="icon-trash bigger-130"> </i> hapus
															</a>
														</div>
													</td>
												</tr>';
											}
										?>									
									</table>
								</div>
							</div>	
						</div>	
						<hr>						
						<div class="row-fluid">
							<div class="span6">
								<div class="table-header header-color-dark" data-html="true" data-original-title="Prakerin hanya diisi sekali dan dapat diedit. <br>Siswa yang belum prakerin, isian dikosongkan.<br>   
								Isian nilai dapat berupa desimal (2 angka dibelakang titik)" data-rel="tooltip">
									Prakerin
								</div>
								<table id="tabel" class="table table-striped table-bordered table-hover inline">
									<tr>
										<th>
											<label>Tempat Praktek</label>
										</th>
										<th>
											<input class="input-xxlarge autosize-transition" type="text" maxlength="50" name="tempat" value="<?php echo $datapra['tempat'] ?>" />
										</th>
									</tr>
									<tr>
										<th>
											<label>Alamat</label>
										</th>
										<th>
											<textarea name="alamat" class="span12 limited autosize-transition " id="form-field-9" maxlength="90"><?php echo $datapra['alamat']; ?></textarea>
										</th>
									</tr>
									<tr>
										<th>
											<label>Nilai</label>
										</th>
										<th>
											<input class="input-mini" type="number" min="0" max="100" step="0.01" name="nilaipra" value="<?php echo $datapra['nilai'] ?>" />
										</th>
									</tr>
								</table>
							</div>
							<div class="span6">
								<div class="table-header header-color-dark" data-original-title="Deskripsi ini akan muncul dalam rapor akhir semester." data-rel="tooltip">
									Deskripsi Kemajuan Belajar Siswa Akhir Semester <?php echo $kodesmt ?>
								</div>
								<textarea name="desks" class="span12 limited autosize-transition " id="form-field-9" data-maxlength="160"><?php 
										echo $datad['deskripsi']; 
									?>
								</textarea>
								<br>
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
					$hek=$_POST['h_efektif'];
					$sakit=$_POST['sakit'];
					$izin=$_POST['izin'];
					$alpha=$_POST['alpha'];
					$terlambat=$_POST['terlambat'];
					if ($hek<$sakit+$izin+$alpha) {
						# jumlah hek sedikit
						echo "<script type='text/javascript'>alert('Jumlah hari sakit, izin, dan tanpa keterangan tidak boleh melebihi jumlah hari efektif')</script>";
					}else if (($hek<$sakit)||($hek<$izin)||($hek<$izin)||($hek<$terlambat)) {
						# hek sedikit
						echo "<script type='text/javascript'>alert('Hari sakit, izin, tanpa keterangan, atau terlambat tidak boleh melebihi hari efektif')</script>";
					}else{
						$tempat=$_POST['tempat'];
						$alamat=$_POST['alamat'];
						$nilaipra=$_POST['nilaipra'];
						$desks=$_POST['desks'];

						$query1="update kehadiran set hari_efektif='$hek', sakit='$sakit', izin='$izin', alpha='$alpha', terlambat='$terlambat' where kode_siswa='$kode' and semester='$kodesmt'";
						$result1=mysqli_query($koneksi,$query1);
						$query2="update nilai set deskripsi='$desks' where kode_siswa='$kode' and semester='$kodesmt'";
						$result2=mysqli_query($koneksi,$query2);
						$query3="update prakerin set tempat='$tempat', alamat='$alamat', nilai='$nilaipra' where kode_siswa='$kode' and kode_kelas='$kodekls'";
						$result3=mysqli_query($koneksi,$query3);
						if($result1&&$result2&&$result3){
							echo "<script type='text/javascript'>alert('Berhasil update')</script>";
							//echo "<script type='text/javascript'>window.history.back();</script>";
							//header('location:admin-guru.php');
							echo "<meta http-equiv='refresh' content='0'>";
						}else{
							echo "<script type='text/javascript'>alert('Gagal')</script>";
						}
					}
				}	
			?>
			<!-- tamabah			-->
			<div id="modal-tambah" class="modal hide fade" tabindex="-1">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>Tambah Ekskul
					</div>
				</div>
				<div class="modal-body">
					<div class="control-group">
						<form method="post" action="#"> 
							<div class="controls">
								<label>
									Pilih Ekskul
								</label>
								<?php 
									$queryeks="select * from ekskul";
									$resulteks=mysqli_query($koneksi,$queryeks);
								 ?>
								<select name="namaeks">
									<?php  
										while ($dataeks=mysqli_fetch_array($resulteks)) {
											if ($dataeks['nama_ekskul']!='') {
												echo "<option value=".$dataeks['kode_ekskul'].">".$dataeks['nama_ekskul']."</option>";
											}
										}
									?>
								</select>
								<label>
									Nilai
								</label>
								<input class="input-mini" type="number" min="0" max="100" step="0.01" name="nilaieks" value="0" />
								<br>												
								<span class="pull-right">
									<button class="btn btn-small" data-dismiss="modal">
										<i class="icon-remove"></i>Cancel
									</button>
									<button class="btn btn-small btn-primary saveeks" type="submit" name="submiteks" value="submit">
										<i class="icon-ok"></i>Save
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--masukan eks-->				
			<?php
				include '../config.php';
				if(isset($_POST['submiteks'])){
					$namaeks=$_POST['namaeks'];
					$nilaieks=$_POST['nilaieks'];
					$query_tambaheks="insert into ekskul_siswa (kode_ekskul, nilai_ekskul, kode_siswa, kode_kelas) values ('$namaeks', '$nilaieks', '$kode', '$kodekls')";
					$result_tambaheks=mysqli_query($koneksi,$query_tambaheks);

					if($result_tambaheks){
						echo "<script type='text/javascript'>alert('Berhasil tambah')</script>";
						echo "<meta http-equiv='refresh' content='0'>";
					}else{
						echo "<script type='text/javascript'>alert('Gagal tambah. Pastikan nama ekskul tidak duplikat')</script>";
					}
				}
			?>
			<!-- tamabah	pre		-->
			<div id="modal-tambahpre" class="modal hide fade" tabindex="-1">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>Tambah Prestasi
					</div>
				</div>
				<div class="modal-body">
					<div class="control-group">
						<form method="post" action="#"> 
							<div class="controls">
								<label>
									Nama Prestasi
								</label>
								<input class="input-large" type="text" maxlength="90" name="namapre"  />						
								<label>
									Keterangan
								</label>
								<textarea name="ketpre" class="span5 limited autosize-transition " id="form-field-9" data-maxlength="180"></textarea>
								<br>												
								<span class="pull-right">
									<button class="btn btn-small" data-dismiss="modal">
										<i class="icon-remove"></i>Cancel
									</button>
									<button class="btn btn-small btn-primary" type="submit" name="submitpre" value="submit">
										<i class="icon-ok"></i>Save
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<!--masukan pre-->				
				<?php
					include '../config.php';
					if(isset($_POST['submitpre'])){
						$namapre=$_POST['namapre'];
						$ket=$_POST['ketpre'];
						$query_tambahpre="insert into prestasi (prestasi, keterangan, kode_siswa, kode_kelas) values ('$namapre', '$ket', '$kode', '$kodekls')";
						$result_tambahpre=mysqli_query($koneksi,$query_tambahpre);

						if($result_tambahpre){
							echo "<script type='text/javascript'>alert('Berhasil tambah')</script>";
							echo "<meta http-equiv='refresh' content='0'>";
						}else{
							echo "<script type='text/javascript'>alert('Gagal tambah.')</script>";
						}
					}
				?>
			</div><!--/.page-content-->
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