<?php
	session_start();
	include '../config.php';
	$ks=$_GET['ks'];

	if($_SESSION['status']!="administrator"){
		header("location:../login.php");
	}

	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilta=$datata['tahun_ajar'];

	$query="select * from siswa where siswa.kode_siswa='$ks'";
	$result=mysqli_query($koneksi,$query);
	$row=mysqli_fetch_array($result);

	$namasiswa=$row['nama_siswa'];
	$nis=$row['nis'];
	$nisn=$row['nisn'];
	$jk=$row['jk'];
	$agm=$row['agama'];
	$tl=$row['tempat_lahir'];
	$tgll=$row['tgl_lahir'];
	$alamat=$row['alamat'];
	$telp=$row['no_telp'];
	$stat=$row['status_siswa'];
	$pass=$row['pass']
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
		<link rel="stylesheet" href="../assets/css/datepicker.css" />		
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
	<!--edit guru-->
		<div id="modal" tabindex="-1">
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left">
						<a href="admin-siswa.php">
							<button class="btn btn-mini" title="kembali tanpa simpan" name="cancel">
								<i class="icon-remove"></i>Kembali
							</button>
						</a> 
					</span>
					Detail Data Siswa
				</div>
			</div>
			<div class="container-fluid">
				<div class="control-group">
					<form method="post" action="#"> 
						<label>
							Nama Lengkap
						</label>
						<input class="input-large" type="text" id="form-field-first" name="namasiswa" required="required" value="<?php echo $namasiswa?>" />
						<label>
							NIS
							<br>
							berfungsi sebagai username siswa saat login
						</label>
						<input class="input-large" type="text"  minlength="1" maxlength="16" pattern="[0-9]+" name="nis" required="required" value="<?php echo $nis?>"/>
						<label>
							NISN
							<br>
							berfungsi sebagai default password siswa
						</label>
						<input class="input-large" type="text" minlength="1" maxlength="16" pattern="[0-9]+" name="nisn" required="required"  value="<?php echo $nisn?>"/>
						<label>
							Kelas
						</label>
						<?php 
							$querykls="select * from kelas where tahun_ajar='$tampilta'";
							$resultkls=mysqli_query($koneksi,$querykls);
						?>
						<select name="kls">
						<?php  
							while ($datakls=mysqli_fetch_array($resultkls)) {
								echo "<option value=".$datakls['kode_kelas'].">".$datakls['kelas']." ".$datakls['peminatan']."";
					    	}
						?>
						</select>
						<label>
							Jenis Kelamin
						</label>
						<select name="jk">
						<?php 
							if ($jk=='L') {
								echo "<option value='L' selected='selected'>Laki-Laki</option>
									<option value='P'>Perempuan</option>";
							}else{
								echo "<option value='L'>Laki-Laki</option>
									<option value='P' selected='selected'>Perempuan</option>";
							}
						?>
						</select>
						<label>
							Agama
						</label>
						<select name="agm">
						<?php 
							if ($agm=='Islam') {
								echo "<option value='Islam' selected='selected'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik'>Katolik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Buddha'>Buddha</option>
									<option value='Kong Hu Cu'>Kong Hu Cu</option>";
							}else if ($agm=='Kristen') {
								echo "<option value='Islam'>Islam</option>
									<option value='Kristen' selected='selected'>Kristen</option>
									<option value='Katolik'>Katolik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Buddha'>Buddha</option>
									<option value='Kong Hu Cu'>Kong Hu Cu</option>";
							}else if ($agm=='Katolik') {
								echo "<option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik' selected='selected'>Katolik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Buddha'>Buddha</option>
									<option value='Kong Hu Cu'>Kong Hu Cu</option>";
							}else if ($agm=='Hindu') {
								echo "<option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik'>Katolik</option>
									<option value='Hindu' selected='selected'>Hindu</option>
									<option value='Buddha'>Buddha</option>
									<option value='Kong Hu Cu'>Kong Hu Cu</option>";
							}else if ($agm=='Buddha') {
								echo "<option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik'>Katolik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Buddha' selected='selected'>Buddha</option>
									<option value='Kong Hu Cu'>Kong Hu Cu</option>";
							}else {
								echo "<option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik'>Katolik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Buddha'>Buddha</option>
									<option value='Kong Hu Cu' selected='selected'>Kong Hu Cu</option>";
							}
						?>
						</select>
						<label>
							Tempat Lahir
						</label>
						<input class="input-large" type="text" maxlength="40" name="tl" required="required"  value="<?php echo $tl?>"/>
						<label>
							Tanggal Lahir
						</label>
						<div class="row-fluid input-append">
							<input class="span4 date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" name="tgll" placeholder="30-11-2000" value="<?php echo $tgll ?>"/>
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
						<label>
							Alamat
						</label>
						<textarea name="alamat" class="span5 limited autosize-transition " id="form-field-9" data-maxlength="90" value="<?php echo $alamat?>">
						</textarea>
						<label>
							No. Telepon
						</label>
						<input class="input-large" type="number"  min="0" name="telp"  value="<?php echo $telp?>"/>
						<label>
							Status Siswa
						</label>
						<select name="stat">
						<?php 
							if ($stat=='A') {
								echo "<option value='A' selected='selected'>Aktif</option>
									<option value='T'>Tidak Aktif</option>";
							}else{
								echo "<option value='A'>Aktif</option>
									<option value='T' selected='selected'>Tidak Aktif</option>";
							}
						?>
						</select>
						<label>
							Password
						</label>
						<div class="accordion" id="accordion2" style="display:inline-block">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">tampilkan
									</a>
								</div>
								<div class="accordion-body collapse" id="collapseOne">
									<div class="accordion-inner">
										<input class="input-large" type="text" id="form-field-first" name="pass" required="required" value="<?php echo $pass?>" />
									</div>
								</div>
							</div>
						</div>
						<br>												
						<button class="btn btn-small btn-primary save" type="submit" name="submit" value="submit">
							<i class="icon-ok"></i>Simpan
						</button>
					</form>
				</div>
			</div>
			<!--masukan guru-->				
			<?php
				include '../config.php';
				if(isset($_POST['submit'])){
					$namasiswa=$_POST['namasiswa'];
					$nis=$_POST['nis'];
					$nisn=$_POST['nisn'];
					$kodekls=$_POST['kls'];
					$jk=$_POST['jk'];
					$agm=$_POST['agm'];
					$tl=$_POST['tl'];
					$tgll=$_POST['tgll'];
					$alamat=$_POST['alamat'];
					$telp=$_POST['telp'];
					$stat=$_POST['stat'];
					$pass=$_POST['pass'];

					$query1="update siswa set nama_siswa='$namasiswa', nis='$nis', nisn='$nisn', jk='$jk', agama='$agm', tempat_lahir='$tl', tgl_lahir='$tgll', alamat='$alamat', no_telp='$telp', status_siswa='$stat', pass='$pass' where kode_siswa=$ks";
					$query2="update kelas_siswa set kode_kelas='$kodekls' where kode_siswa=$ks";
					$query3="update prakerin set kode_kelas='$kodekls' where kode_siswa=$ks";//prakerin
					$query4="update prestasi set kode_kelas='$kodekls' where kode_siswa=$ks";//prestasi

					$result1=mysqli_query($koneksi,$query1);
					$result2=mysqli_query($koneksi,$query2);
					$result3=mysqli_query($koneksi,$query3);
					$result4=mysqli_query($koneksi,$query4);

					if($result1&&$result2&&$result3&&$result4){
						echo "<script type='text/javascript'>alert('berhasil update')</script>";
						echo "<script type='text/javascript'>window.location.href='admin-siswa.php';</script>";
						//header('location:admin-guru.php');
						//echo "<meta http-equiv='refresh' content='0'>";
					}else{
						echo "<script type='text/javascript'>alert('gagal')</script>";
					}
				}
			?>
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
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
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
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
		</script>
	</body>
</html>