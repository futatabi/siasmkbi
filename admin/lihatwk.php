<?php
	session_start();
	include '../config.php';
	$kw=$_GET['kw'];

	if($_SESSION['status']!="administrator"){
		header("location:../login.php");
	}

	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilta=$datata['tahun_ajar'];

	$query="select * from walikelas where kode_wali='$kw'";
	$result=mysqli_query($koneksi,$query);
	$row=mysqli_fetch_array($result);

	$user=$row['user_wali'];
	$pass=$row['pass'];
	$kodekls=$row['kode_kelas'];
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
	<!--edit wk-->
		<div id="modal" tabindex="-1">
			<div class="modal-header center no-padding">
				<div class="table-header">
					<span class="pull-left">
						<a href="admin-wk.php">
							<button class="btn btn-mini" title="kembali tanpa simpan" name="cancel">
								<i class="icon-remove"></i>Kembali
							</button>
						</a> 
					</span>
					Detail Data Wali Kelas
				</div>
			</div>
			<div class="container-fluid">
				<div class="control-group">
					<form method="post" action="#"> 
						<label>
							Username
						</label>
						<input class="input-large" type="text" id="form-field-first" name="user" maxlength="25" required="required" value="<?php echo $user ?>" />
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
										<input class="input-large" type="text"  maxlength="16" name="sandi" required="required" value="<?php echo $pass ?>" />
									</div>
								</div>
							</div>
						</div>						
						<label>
							Kelas
							<br>
							<small>mohon diedit sesuai tahun ajaran terbaru</small>
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
						<br>												
						<button class="btn btn-small btn-primary" type="submit" name="submit" value="submit">
							<i class="icon-ok"></i>Save
						</button>			
					</form>
				</div>
			</div>
			<!--masukan guru-->				
			<?php
				include '../config.php';
				if(isset($_POST['submit'])){
					$user=$_POST['user'];
					$pass=$_POST['sandi'];
					$kodekls=$_POST['kls'];
					$query="update walikelas set user_wali='$user', pass='$pass', kode_kelas='$kodekls' where kode_wali=$kw";
					$result=mysqli_query($koneksi,$query);

					if($result){
						echo "<script type='text/javascript'>alert('berhasil update')</script>";
						echo "<script type='text/javascript'>window.location.href='admin-wk.php';</script>";
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