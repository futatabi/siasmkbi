<?php
	session_start();
	include '../config.php';
	if($_SESSION['status']!="administrator"){
		header("location:../loginadm.php");
	}
	$user=$_SESSION['user'];
	$queryadm="select nama_admin from administrator where user='$user'";
	$resultadm=mysqli_query($koneksi,$queryadm);
	        while($data=mysqli_fetch_array($resultadm)){
	            $namaadm=$data['nama_admin'];}

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
							<img src="../assets/images/logobi-25.png" width="15%">
							SIA SMK BI
						</small>
					</a><!--/.brand-->
					<ul class="nav ace-nav pull-right">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Selamat Datang,</small>
									<small><?php echo $namaadm ?></small>
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
							<li class="active">
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
							<li>
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
								<a href="admin-pel.php" title="Refresh Halaman ini">
									<h3 class="header smaller lighter blue">Tabel Mata Pelajaran
									</h3>
								</a>
								<div class="table-header">
									<form class="form-inline" method="post" action="#">
										<div class="row-fluid">
											<div class="span10">
											<?php
												echo "Tahun Ajaran : $tampilta";
											 ?>								
											</div>
											<div class="span2">
												<a href="#modal-tambah" role="button"  data-toggle="modal">
													<button onclick="return false;" class="btn btn-mini btn-success" title="tambah mata pelajaran kelas">
														<i class="icon-plus"></i> Tambah
													</button>
												</a>
											</div>
										</div>
									</form>		
								</div>
						 		<div class="alert alert-warning">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>
									Pastikan tidak ada KELAS yang duplikat dalam satu guru mata pelajaran.								
								</div>
								<table id="tabel-mp" class="table table-striped table-bordered table-hover ">
									<thead>
										<tr>
											<th>Guru</th>
											<th>Mata Pelajaran</th>
											<th>Kelas</th>
											<th>Muatan</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<!--tabel-->
										<?php
										    include '../config.php';
											$query="select mpelajaran.kode_mp, mpelajaran.nama_mp, mpelajaran.muatan, guru.nama_guru, kelas.kelas, kelas.peminatan from guru, kelas, mpelajaran where guru.kode_guru=mpelajaran.kode_guru and mpelajaran.kode_kelas=kelas.kode_kelas and guru.status_guru='A'";
										    $result=mysqli_query($koneksi,$query);

										    while ($data=mysqli_fetch_array($result)) {
										    	echo "<td>".$data['nama_guru']."</td>
										    		<td>".$data['nama_mp']."</td>
										    		<td>".$data['kelas']." ".$data['peminatan']."</td>
										    		<td>".$data['muatan']."</td>";
										    	echo '<td class="td-actions">
													<div class="hidden-phone visible-desktop action-buttons">
														<a class="red" href="hapuspel.php?kp='.$data['kode_mp'].'">
															<i class="icon-trash bigger-130"> </i> hapus
														</a>
													</div>
													<div class="hidden-desktop visible-phone">
														<ul class="unstyled spaced">
															<li>
																<a href="hapuspel.php?kp='.$data['kode_mp'].'" class="tooltip-error" data-rel="tooltip" title="Hapus">
																	<span class="red">
																		<i class="icon-trash bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>';
										    }
										?>
									</tbody>
								</table>
							</div>
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
					<!-- tamabah mp			-->
					<div id="modal-tambah" class="modal hide fade" tabindex="-1">
						<div class="modal-header no-padding">
							<div class="table-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								Tambah Data Mata Pelajaran Kelas
							</div>
						</div>
						<div class="modal-body" style="height: 80%">
							<div class="control-group">
								<form method="post" action="#">
									<div class="controls">
									<?php 
										$querykls="select * from kelas where tahun_ajar='$tampilta'";
										$queryg="select distinct guru.kode_guru, guru.nama_guru, mpelajaran.nama_mp from guru, mpelajaran where guru.kode_guru=mpelajaran.kode_guru and guru.status_guru='A' order by guru.nama_guru asc";
										$resultkls=mysqli_query($koneksi,$querykls);
										$resultg=mysqli_query($koneksi,$queryg);
									?>
										<label>Guru Mata Pelajaran</label>
										<select name="gmp">
										<?php  
											while ($datag=mysqli_fetch_array($resultg)) {
									    		echo "<option value=".$datag['kode_guru'].">".$datag['nama_guru']." ".$datag['nama_mp']."</option>";
									    	}
										?>
										</select>
										<label>Kelas</label>
										<select name="kls">
										<?php  
											while ($datakls=mysqli_fetch_array($resultkls)) {
									    		echo "<option value=".$datakls['kode_kelas'].">".$datakls['kelas']." ".$datakls['peminatan']."</option>";
									    	}
										?>
										</select>
										<br>												
										<span class="pull-right">
											<button class="btn btn-small" data-dismiss="modal">
												<i class="icon-remove"></i>
												Cancel
											</button>
											<button class="btn btn-small btn-primary" type="submit" name="submit" value="submit">
													<i class="icon-ok"></i>
													Save
											</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<!--masukan kls guru-->				
						<?php
							include '../config.php';

							if(isset($_POST['submit'])){
								$kodekls=$_POST['kls'];
								$kodeguru=$_POST['gmp'];

								$querymp="select * from mpelajaran where kode_guru='$kodeguru' order by kode_guru desc limit 1";
								$mp=mysqli_query($koneksi,$querymp);
								$datamp=mysqli_fetch_array($mp);
								$tampilmp=$datamp['nama_mp'];
								$tampilmu=$datamp['muatan'];

								$querymp2="insert into mpelajaran (nama_mp, muatan, kkm, bobot_tgsp_ga, bobot_uhp_ga, bobot_tgsk_ga, bobot_uhk_ga, bobot_tgsp_ge, bobot_uhp_ge, bobot_tgsk_ge, bobot_uhk_ge, bobot_uts_ga, bobot_uas_ga, bobot_uts_ge, bobot_uas_ge, kode_guru, kode_kelas) values ('$tampilmp', '$tampilmu', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '$kodeguru', '$kodekls')";
								$resultmp2=mysqli_query($koneksi,$querymp2);
								if($resultmp2){
									$querytmp="select kode_mp from mpelajaran where kode_kelas='$kodekls' and kode_guru='$kodeguru' order by kode_mp desc limit 1";
									$tmp=mysqli_query($koneksi,$querytmp);
									$datatmp=mysqli_fetch_array($tmp);
									$tampilkmp=$datatmp['kode_mp'];
								//nilai
									$querysiswa="select siswa.kode_siswa, kelas_siswa.kode_kelas from siswa, kelas_siswa where siswa.kode_siswa=kelas_siswa.kode_siswa and kode_kelas='$kodekls'";
									$ks=mysqli_query($koneksi,$querysiswa);
									while ($dataks=mysqli_fetch_array($ks)) {
										$tampilks=$dataks['kode_siswa'];
										$querynilai="insert into nilai (semester, kode_kelas, kode_siswa, kode_guru, kode_mp, jum_tgs_peng, jum_uh_peng, jum_tgs_keter, jum_uh_keter) values ('Ganjil', '$kodekls', '$tampilks', '$kodeguru', '$tampilkmp', 0, 0, 0, 0)";
										$nilai=mysqli_query($koneksi,$querynilai);
										$querynilai2="insert into nilai (semester, kode_kelas, kode_siswa, kode_guru, kode_mp, jum_tgs_peng, jum_uh_peng, jum_tgs_keter, jum_uh_keter) values ('Genap', '$kodekls', '$tampilks', '$kodeguru', '$tampilkmp', 0, 0, 0, 0)";
										$nilai2=mysqli_query($koneksi,$querynilai2);
									}
									echo "<meta http-equiv='refresh' content='0'>";
									echo "<script type='text/javascript'>alert('berhasil tambah')</script>";
								}else{
									echo "<script type='text/javascript'>alert('gagal')</script>";
								}
							}
						?>
				</div>

				<!--/.page-content-->
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
			return confirm('Hapus Pelajaran ini?\nMenghapus berpengaruh pada data penilaian yang terkait');
		});
		$('.logout').on('click', function(){
			return confirm('Anda Yakin?');
		});
		</script>
		<script type="text/javascript">
			$(function() {
			
			var oTable1 = $('#tabel-mp').dataTable( {
			"aoColumns": [
		     null, null, null, null,
			{ "bSortable": false }				  
			] } );
													
			$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();
		
				var off2 = $source.offset();
				var w2 = $source.width();
		
				if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
				return 'left';
			}
			
		})
		</script>
	</body>
</html>