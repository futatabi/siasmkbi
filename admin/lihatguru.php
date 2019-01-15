<?php
	session_start();
	include '../config.php';
	$kg=$_GET['kg'];

	if($_SESSION['status']!="administrator"){
		header("location:../login.php");
	}
	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilta=$datata['tahun_ajar'];

	$query="select * from guru, mpelajaran where guru.kode_guru=mpelajaran.kode_guru and guru.kode_guru='$kg'";
	$result=mysqli_query($koneksi,$query);
	$row=mysqli_fetch_array($result);

	$namaguru=$row['nama_guru'];
	$nip=$row['nip'];
	$jk=$row['jk'];
	$alamat=$row['alamat'];
	$telp=$row['no_telp'];
	$pass=$row['pass'];
	$stat=$row['status_guru'];
	$pel=$row['nama_mp'];
	$muatan=$row['muatan'];

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
	<!--edit guru-->
		<div id="modal" tabindex="-1">
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left">
						<a href="admin-guru.php">
							<button class="btn btn-mini" title="kembali tanpa simpan" name="cancel">
								<i class="icon-remove"></i>Kembali
							</button>
						</a>
					</span>
					Detail Data Guru
				</div>
			</div>
			<div class="container-fluid">
				<div class="control-group">
					<form method="post" action="#"> 
						<label>
							Nama Lengkap
						</label>
						<input class="input-large" type="text" id="form-field-first" name="namaguru" required="required" value="<?php echo $namaguru?>" />
						<label>
							NIP
							<br>
							<small>atau username</small>
						</label>
						<input class="input-large" type="number"  min="0" max="999999999999999999" name="nip" required="required" value="<?php echo $nip?>" />
						<label>
							Mata Pelajaran
						</label>
						<input class="input-large" type="text" id="form-field-first" name="mp" required="required" value="<?php echo $pel?>" />
						<label>
							Muatan Pelajaran
						</label>
						<select name="muatan">
						<?php 
							if ($muatan=='Nasional') {
								echo "<option value='Nasional' selected='selected'>Nasional</option>
									<option value='Lokal'>Lokal</option>
									<option value='Peminatan Kejuruan'>Peminatan Kejuruan</option>";
							}else if ($muatan=='Lokal') {
								echo "<option value='Nasional'>Nasional</option>
									<option value='Lokal' selected='selected'>Lokal</option>
									<option value='Peminatan Kejuruan'>Peminatan Kejuruan</option>";
							}else{
								echo "<option value='Nasional'>Nasional</option>
									<option value='Lokal'>Lokal</option>
									<option value='Peminatan Kejuruan' selected='selected'>Peminatan Kejuruan</option>";
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
							Alamat
						</label>
						<textarea name="alamat" class="span4 limited autosize-transition" id="form-field-9" data-maxlength="90"  value="<?php echo $alamat?>" >
						</textarea>
						<label>
							No. Telepon
						</label>
						<input class="input-large" type="number" name="telp" value="<?php echo $telp?>" />
						<label>
							Status Guru
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
									<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
										tampilkan
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
					$kg=$_GET['kg'];
					$namaguru1=$_POST['namaguru'];
					$nip1=$_POST['nip'];
					$mp1=$_POST['mp'];
					//$kodekls1=$_POST['kls'];
					$jk1=$_POST['jk'];
					$alamat1=$_POST['alamat'];
					$telp1=$_POST['telp'];
					$stat1=$_POST['stat'];
					$pass1=$_POST['pass'];

					$query1="update guru set nama_guru='$namaguru1', nip='$nip1', jk='$jk1', alamat='$alamat1', no_telp='$telp1', status_guru='$stat1', pass='$pass1' where kode_guru=$kg";
					$query2="update mpelajaran set nama_mp='$mp1' where kode_guru=$kg";

					$result1=mysqli_query($koneksi,$query1);
					$result2=mysqli_query($koneksi,$query2);
					
					if($result1&&$result2){
						echo "<script type='text/javascript'>alert('Berhasil update')</script>";
						echo "<script type='text/javascript'>window.location.href='admin-guru.php';</script>";
						//header('location:admin-guru.php');
						//echo "<meta http-equiv='refresh' content='0'>";
					}else{
						echo "<script type='text/javascript'>alert('Gagal, pastikan NIP tidak duplikat')</script>";
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