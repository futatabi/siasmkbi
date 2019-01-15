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
        $nama=$data['nama_admin'];}

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
							<li class="active">
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
								<a href="admin-siswa.php" title="Refresh Halaman ini">
									<h3 class="header smaller lighter blue">Tabel Siswa
									</h3>
								</a>
								<div class="table-header" >
									<form class="form-inline" method="post" action="#">
										<div class="row-fluid">
											<div class="span10">
											<?php
												echo "Tahun Ajaran : $tampilta";
											?>								
											</div>
											<div class="span2">
												<a href="#modal-tambah" role="button"  data-toggle="modal">
													<button onclick="return false;" class="btn btn-mini btn-success" title="tambah siswa">
														<i class="icon-plus"></i> Tambah Siswa
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
									Tiap penambahan tahun ajaran, kelas siswa harus diedit (klik pada bagian detail) apabila siswa tersebut pindah / naik kelas. Apabila siswa lulus / keluar dari sekolah, status siswa harus diganti menjadi tidak aktif.
									<br />
								</div>
								<table id="tabel-siswa" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>NIS</th>
											<th>NISN</th>
											<th>Nama</th>
											<th>JK</th>
											<th>Kelas</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<!--tabel-->
										<?php
										    include '../config.php';
										    $querytbl="select siswa.nis, siswa.nisn, siswa.nama_siswa, siswa.jk, siswa.kode_siswa, siswa.status_siswa, kelas.kelas, kelas.peminatan from kelas, siswa, kelas_siswa where kelas.kode_kelas=kelas_siswa.kode_kelas and kelas_siswa.kode_siswa=siswa.kode_siswa and siswa.status_siswa='A';";
										    	$resulttbl=mysqli_query($koneksi,$querytbl);
										    	while ($datatbl=mysqli_fetch_array($resulttbl)) {
										    		echo "<td>".$datatbl['nis']."</td>
											    		<td>".$datatbl['nisn']."</td>
											    		<td>".$datatbl['nama_siswa']."</td>
											    		<td>".$datatbl['jk']."</td>
											    		<td>".$datatbl['kelas']." ".$datatbl['peminatan']."</td>";
											    	echo '<td class="td-actions">
														<div class="hidden-phone visible-desktop action-buttons">
															<a class="green" href="lihatsiswa.php?ks='.$datatbl['kode_siswa'].'" >
																<i class="icon-pencil bigger-130"> </i> detail
															</a>
															<a class="red" href="hapussiswa.php?ks='.$datatbl['kode_siswa'].'">
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
																		<a href="lihatsiswa.php?ks='.$datatbl['kode_siswa'].'" class="tooltip-success" data-rel="tooltip" title="Detail">
																			<span class="green">
																				<i class="icon-edit bigger-120"></i>
																			</span>
																		</a>
																	</li>
																	<li>
																		<a class="red" href="hapussiswa.php?ks='.$datatbl['kode_siswa'].'" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
										    ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!--PAGE CONTENT ENDS-->
					</div><!--/.span-->
				</div><!--/.row-fluid-->
					<!-- tamabah siswa			-->
				<div id="modal-tambah" class="modal hide fade" tabindex="-1" style="height: 80%">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							Tambah Data Siswa
						</div>
					</div>
					<div class="modal-body" style="height: 80%">
						<div class="control-group">
							<label class="control-label" for="form-field-first">Masukkan data siswa untuk tahun ajaran terbaru.
							</label>
							<form method="post" action="#"> 
								<div class="controls">
									<label>
									Nama Lengkap
									</label>
									<input class="input-large" type="text" id="form-field-first" name="namasiswa" required="required" />
									<label>
										NIS
										<br>
										berfungsi sebagai username siswa saat login
									</label>
									<input class="input-large" type="text"  minlength="1"  maxlength="16" pattern="[0-9]+" name="nis" required="required"/>
									<label>
										NISN
										<br>
										berfungsi sebagai default password siswa
									</label>
									<input class="input-large" type="text" minlength="1" maxlength="16" pattern="[0-9]+" name="nisn" required="required" />
									<label>
										Kelas
									</label>
									<?php 
										$querykls="select * from kelas where tahun_ajar='$tampilta' order by kelas asc";
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
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
									<label>
										Agama
									</label>
									<select name="agm">
										<option value="Islam">Islam</option>
										<option value="Kristen">Kristen</option>
										<option value="Katolik">Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Buddha">Buddha</option>
										<option value="Kong Hu Cu">Kong Hu Cu</option>
									</select>
									<label>
										Tempat Lahir
									</label>
									<input class="input-large" type="text" maxlength="40" name="tl" />
									<label>
										Tanggal Lahir
									</label>
									<div class="row-fluid input-append">
										<input class="span4 date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" name="tgll" placeholder="30-11-2000" />
										<span class="add-on">
											<i class="icon-calendar"></i>
										</span>
									</div>
									<label>
										Alamat
									</label>
									<textarea name="alamat" class="span5 limited autosize-transition " id="form-field-9" data-maxlength="90"></textarea>
									<label>
										No. Telepon
									</label>
									<input class="input-large" type="number"  min="0" name="telp" />
									<label>
										Status Siswa
									</label>
									<select name="stat">
										<option value="A">Aktif</option>
										<option value="T">Tidak Aktif</option>
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
							$query="insert into siswa (nis, nisn, nama_siswa, jk, agama, tempat_lahir, tgl_lahir, alamat, no_telp, status_siswa, pass) values ('$nis', '$nisn', '$namasiswa', '$jk', '$agm', '$tl', '$tgll','$alamat', '$telp', '$stat', '$nisn')";
							$result=mysqli_query($koneksi,$query);
							if($result){
								$queryks="select kode_siswa from siswa order by kode_siswa desc limit 1";
								$ks=mysqli_query($koneksi,$queryks);
								$dataks=mysqli_fetch_array($ks);
								$tampilks=$dataks['kode_siswa'];

								$querykls="insert into kelas_siswa (kode_kelas, kode_siswa) values ('$kodekls', '$tampilks')";
								$simpankls=mysqli_query($koneksi,$querykls);

								$querykoden="select kode_guru, kode_mp from mpelajaran where kode_kelas='$kodekls'";
								$kn=mysqli_query($koneksi,$querykoden);
								while ($datakn=mysqli_fetch_array($kn)){
									$tampilguru=$datakn['kode_guru'];
									$tampilmp=$datakn['kode_mp'];
								//nilai
									$querynilai="insert into nilai (semester, kode_kelas, kode_siswa, kode_guru, kode_mp, jum_tgs_peng, jum_uh_peng, jum_tgs_keter, jum_uh_keter) values ('Ganjil', '$kodekls', '$tampilks', '$tampilguru', '$tampilmp', 0, 0, 0, 0)";
									$nilai=mysqli_query($koneksi,$querynilai);
									$querynilai2="insert into nilai (semester, kode_kelas, kode_siswa, kode_guru, kode_mp, jum_tgs_peng, jum_uh_peng, jum_tgs_keter, jum_uh_keter) values ('Genap', '$kodekls', '$tampilks', '$tampilguru', '$tampilmp', 0, 0, 0, 0)";
									$nilai2=mysqli_query($koneksi,$querynilai2);
								}
							//kehadiran
								$querykehadiran="insert into kehadiran (semester, kode_kelas, kode_siswa) values ('Ganjil', '$kodekls', '$tampilks')";
								$kehadiran=mysqli_query($koneksi,$querykehadiran);
								$querykehadiran2="insert into kehadiran (semester, kode_kelas, kode_siswa) values ('Genap', '$kodekls', '$tampilks')";
								$kehadiran2=mysqli_query($koneksi,$querykehadiran2);
							//ekskul
								$queryekskul="insert into ekskul_siswa (kode_kelas, kode_siswa, kode_ekskul) values ('$kodekls', '$tampilks', '0')";
								$ekskul=mysqli_query($koneksi,$queryekskul);
							//prakerin
								$queryprakerin="insert into prakerin (kode_kelas, kode_siswa) values ('$kodekls', '$tampilks')";
								$prakerin=mysqli_query($koneksi,$queryprakerin);
								echo "<meta http-equiv='refresh' content='0'>";
								echo "<script type='text/javascript'>alert('berhasil tambah siswa')</script>";
							}else{
								echo "<script type='text/javascript'>alert('gagal, periksa lagi nis tidak boleh sama')</script>";
							}
						}
					?>
				</div>
			</div>
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
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">
			$('.red').on('click', function(){
				return confirm('Hapus Siswa ini?\nMenghapus siswa berpengaruh pada data penilaian siswa ini');
			});


			$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#tabel-siswa').dataTable( {
				"aoColumns": [
			     null, null, null, null, null,
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
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
		</script>		
	</body>
</html>
