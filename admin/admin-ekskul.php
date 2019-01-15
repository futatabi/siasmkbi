<?php
	session_start();
	include '../config.php';
	if($_SESSION['status']!="administrator"){
		header("location:../loginadm.php");
	}
	$user=$_SESSION['user'];

	$query="select nama_admin from administrator where user='$user'";
	$result=mysqli_query($koneksi,$query);
	while($data=mysqli_fetch_array($result)){
		$nama=$data['nama_admin'];
	}

	$queryta="select tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$data=mysqli_fetch_array($ta);
	$tampilta=$data['tahun_ajar'];

	$query2="select * from kelas where kelas.tahun_ajar='$tampilta' order by kelas.kelas";
	$result2=mysqli_query($koneksi,$query2);            
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
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<img src="../assets/images/logobi-25.png" width="15%"/>
							SIA SMK BI
						</small>
					</a><!--/.brand-->
					<ul class="nav ace-nav pull-right">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Selamat Datang,</small>
									<small><?php echo $nama ?></small>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../logoutadm.php" title="keluar dari akun ini" class="logout">
										<i class="icon-off"></i>
										Logout
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
						<a href="admin.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="icon-folder-open-alt "></i>
							<span class="menu-text"> Data Sekolah </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="admin-kelas.php">
									<i class="icon-double-angle-right"></i>Kelas
								</a>
							</li>
							<li>
								<a href="admin-guru.php">
									<i class="icon-double-angle-right"></i>Guru
								</a>
							</li>
							<li>
								<a href="admin-pel.php">
									<i class="icon-double-angle-right"></i>Pelajaran
								</a>
							</li>
							<li>
								<a href="admin-wk.php">
									<i class="icon-double-angle-right"></i>Wali Kelas
								</a>
							</li>
							<li>
								<a href="admin-siswa.php">
									<i class="icon-double-angle-right"></i>Siswa
								</a>
							</li>
							<li class="active">
								<a href="admin-ekskul.php">
									<i class="icon-double-angle-right"></i>Ekskul
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-book "></i>
							<span class="menu-text"> Data Penilaian </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<?php
							while ($datakls=mysqli_fetch_array($result2)) {
								echo '<li class="active open">
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
								echo $datakls['kelas']." <br>".$datakls['peminatan'];
								echo '<b class="arrow icon-angle-down"></b></a>
										<ul class="submenu">
											<li>
												<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=01">
														<i class="icon-adjust"></i>
														Semester Ganjil
												</a>
											</li>
											<li>
												<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=11">
														<i class="icon-circle"></i>
														Semester Genap
												</a>
											</li>
										</ul>
									</li>';
							}
							?>
						</ul>
					</li>
				</ul>
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>
			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<a href="admin-ekskul.php" title="Refresh Halaman ini">
									<h3 class="header smaller lighter blue">Tabel Ekskul</h3>
								</a>
								<div class="table-header" >
									<a href="#modal-tambah" role="button"  data-toggle="modal">
										<button onclick="return false;" class="btn btn-mini btn-success" title="tambah data guru">
											<i class="icon-plus"></i>Tambah Ekskul
										</button>
									</a>
								</div>
								<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Nama Ekskul</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<!--tabel-->
											<?php
										    	include '../config.php';
											    $query="select * from ekskul";
										    	$result=mysqli_query($koneksi,$query);
										    	while ($data=mysqli_fetch_array($result)) {
										    		if ($data['kode_ekskul']>0) {
										    			echo "<td>".$data['nama_ekskul']."</td>";
												    	echo '<td class="td-actions">
																<div class="hidden-phone visible-desktop action-buttons">
																	<a class="green" href="lihatekskul.php?ke='.$data['kode_ekskul'].'" >
																		<i class="icon-pencil bigger-130"> </i> edit
																	</a>
																	<a class="red" href="hapusekskul.php?ke='.$data['kode_ekskul'].'">
																		<i class="icon-trash bigger-130"> </i> hapus
																	</a>
																</div>
																<div class="hidden-desktop visible-phone">
																	<div class="inline position-relative">
																		<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																			<i class="icon-caret-down icon-only bigger-120"></i>
																		</button>
																		<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
																			<li>
																				<a href="lihatekskul.php?ke='.$data['kode_ekskul'].'" class="tooltip-success" data-rel="tooltip" title="Edit">
																					<span class="green">
																						<i class="icon-edit bigger-120"></i>
																					</span>
																				</a>
																			</li>
																			<li>
																				<a class="red" href="hapusekskul.php?ke='.$data['kode_ekskul'].'" class="tooltip-error" data-rel="tooltip" title="Hapus">
																					<span class="red">
																						<i class="icon-trash bigger-120"></i>
																					</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</td>
														</tr>';
										    		}
										    	}
										    ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div><!--/.span12-->
						<!--PAGE CONTENT ENDS-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
				<div id="modal-tambah" class="modal hide fade" tabindex="-1">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							Tambah Ekskul
						</div>
					</div>
					<div class="modal-body">
						<div class="control-group">
							<form method="post" action="#"> 
								<div class="controls">
									<input class="input-xlarge" type="text" id="form-field-first" name="namaekskul" required="required" minlength="1" maxlength="30" /> 
									<br>												
									<span class="pull-right">
										<button class="btn btn-small" data-dismiss="modal">
											<i class="icon-remove"></i>
											Cancel
										</button>
										<button class="btn btn-small btn-primary saveth" type="submit" name="submit" value="submit">
											<i class="icon-ok"></i>
											Save
										</button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<!--masukan eskul-->				
					<?php
						include '../config.php';
						if(isset($_POST['submit'])){
							$namae=$_POST['namaekskul'];
							$query="insert into ekskul (nama_ekskul) values ('$namae')";
							$simpan=mysqli_query($koneksi,$query);
							if($simpan){
								echo "<meta http-equiv='refresh' content='0'>";
							}else{
								echo "<script type='text/javascript'>alert('gagal')</script>";
							}
						}
					?>
				</div><!--/.modal-tambah-->

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
			$('.red').on('click', function(){
				return confirm('Hapus Ekskul ini?\nMenghapus ekskul berpengaruh pada data nilai yang terkait dengan ekskul ini');
			});
			$('.saveth').on('click', function(){
				return confirm('Tambah?\nPastikan tidak ada nama ekskul yang duplikat');
			});
			$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
	</body>
</html>