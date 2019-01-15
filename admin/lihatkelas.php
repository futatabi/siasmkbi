<?php
	session_start();
	include '../config.php';
	$kode=$_GET['kk'];
	
	if($_SESSION['status']!="administrator"){
		header("location:../login.php");
	}

	$query="select * from kelas where kode_kelas='$kode'";
	$result=mysqli_query($koneksi,$query);
	$row=mysqli_fetch_array($result);

	$kls=$row['kelas'];
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
	<!--edit kelas-->
		<div id="modal" class="center" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header" style="line-height: 340%">
					<a href="admin-kelas.php" type="button" class="close" data-dismiss="modal">&times;</a>Edit Kelas
				</div>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<form method="post" action="#"> 
						<div class="controls">
							<input class="input-small" type="text" id="form-field-first" placeholder="XII-B" minlength="1" maxlength="5" name="kelas" required="required" value="<?php echo $kls ?>" />
							<select class="input-medium" name="peminatan">
							<?php 
								if ($pem=='Rekayasa Perangkat Lunak') {
									echo "<option value='Rekayasa Perangkat Lunak' selected='selected' >Rekayasa Perangkat Lunak</option>
										<option value='Teknik Komputer Jaringan'>Teknik Komputer Jaringan</option>
										<option value='Multimedia'>Multimedia</option>";
								}else if ($pem=='Teknik Komputer Jaringan') {
									echo "<option value='Rekayasa Perangkat Lunak' >Rekayasa Perangkat Lunak</option>
										<option value='Teknik Komputer Jaringan' selected='selected' >Teknik Komputer Jaringan</option>
										<option value='Multimedia'>Multimedia</option>";
								}else{
									echo "<option value='Rekayasa Perangkat Lunak' >Rekayasa Perangkat Lunak</option>
										<option value='Teknik Komputer Jaringan'  >Teknik Komputer Jaringan</option>
										<option value='Multimedia'selected='selected'>Multimedia</option>";
								}
							?>
							</select>
							<br>
							<button class="btn btn-small" data-dismiss="modal" name="kembali">
								<i class="icon-remove"></i>Cancel
							</button>
							<button class="btn btn-small btn-primary" type="submit" name="submitkelas" value="submit">
								<i class="icon-ok"></i>Save
							</button>
						</div>
					</form>
				</div>
				<?php
					include '../config.php';
					if(isset($_POST['submitkelas'])){
						$kls=$_POST['kelas'];
						$pem=$_POST['peminatan'];
						$query="update kelas set kelas='$kls', peminatan='$pem' where kode_kelas='$kode'";
						$simpan=mysqli_query($koneksi,$query);

						if($simpan){
							echo "<script type='text/javascript'>alert('berhasil tambah kelas')</script>";
							header("location:admin-kelas.php#");
						}else{
							echo "<script type='text/javascript'>alert('gagal')</script>";
						}
					}else if(isset($_POST['kembali'])){
						echo "<script type='text/javascript'>window.location.href='admin-kelas.php';</script>";
					}
				?>
			</div>
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

	</body>
</html>