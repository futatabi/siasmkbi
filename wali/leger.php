<?php
	/* 
	require_once("../assets/dompdf/dompdf_config.inc.php");

	$html =
	  '<html><body>'.
	  '<h1>Halo, '.$nama.' berikut alamat Anda : </h1>'.
	  '<p>Alamat lengkap Anda adalah : '.$alamat.'</p>'.
	  '</body></html>';
	 
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream('Laporan Nilai Kelas '.$nama.'.pdf');
	*/ 
	// session_start();
	// include '../config.php';
	// $smt=$_GET['smt'];
	// $kk=$_GET['kk'];
	if($_SESSION['status']!="walikelas"){
		header("location:../loginwali.php");
	}
	if ($smt==01) {
		$kodesmt="Ganjil";
	}else{
		$kodesmt="Genap";
	}
	$queryta="select kelas, peminatan, tahun_ajar from kelas where kode_kelas='$kk'";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$kls=$datata['kelas'];
	$peminatan=$datata['peminatan'];
	$tampilta=$datata['tahun_ajar'];
	//nasional
	$querymn="select * from mpelajaran where kode_kelas='$kk' and muatan='Nasional'";
	$resultmn=mysqli_query($koneksi,$querymn);//nama mp
	$resultmn2=mysqli_query($koneksi,$querymn);//P&K
	$resultmn4=mysqli_query($koneksi,$querymn);//JN
	$resultmn5=mysqli_query($koneksi,$querymn);//Rerata
	$rowmn=mysqli_num_rows($resultmn);
	//lokal
	$queryml="select * from mpelajaran where kode_kelas='$kk' and muatan='Lokal'";
	$resultml=mysqli_query($koneksi,$queryml);
	$resultml2=mysqli_query($koneksi,$queryml);
	$resultml4=mysqli_query($koneksi,$queryml);
	$resultml5=mysqli_query($koneksi,$queryml);
	$rowml=mysqli_num_rows($resultml);
	//peminatan
	$querymp="select * from mpelajaran where kode_kelas='$kk' and muatan='Peminatan Kejuruan'";
	$resultmp=mysqli_query($koneksi,$querymp);
	$resultmp2=mysqli_query($koneksi,$querymp);
	$resultmp4=mysqli_query($koneksi,$querymp);
	$resultmp5=mysqli_query($koneksi,$querymp);
	$rowmp=mysqli_num_rows($resultmp);
	$queryrp="select kode_siswa, sum(nilai_peng) as sump from nilai where kode_kelas='$kk' and semester='$kodesmt' group by kode_siswa order by sump desc";
	$resultrp=mysqli_query($koneksi,$queryrp);
	// rank position array
	$rankp = array();
	while ($rowrp = mysqli_fetch_array($resultrp)) {
	    $rankp[] = $rowrp['kode_siswa'];
	}

	$queryrk="select kode_siswa, sum(nilai_keter) as sumk from nilai where kode_kelas='$kk' and semester='$kodesmt' group by kode_siswa order by sumk desc";
	$resultrk=mysqli_query($koneksi,$queryrk);
	// rank position array
	$rankk = array();
	while ($rowrk = mysqli_fetch_array($resultrk)) {
	    $rankk[] = $rowrk['kode_siswa'];
	}
	//$fileName = "smksia.xls";
	//header("Content-Disposition: attachment; filename='$fileName");
	//header("Content-Type: application/vnd.ms-excel");
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Laporan Leger</title>
		<style type="text/css">
			hr {
				border-width: 1px;
				border-color: black;
			}
			h1, h2, h3, h4, h5 {
				margin: 0;
			}
			div.rotate {
				white-space: nowrap;
				position: relative;
				overflow: hidden;
				writing-mode: vertical-rl;
				text-align: center;
				vertical-align: middle;
			}
		</style>
	</head>
	<body>				
	<!--PAGE CONTENT BEGINS-->
		<h3 align="center">LEGER SEMESTER 
			<?php 
				echo strtoupper($kodesmt) 
			?>
		</h3>
		<h4 align="center">
			TAHUN AJARAN 
			<?php echo $tampilta  ?>
			<br>
			KELAS 
			<?php echo strtoupper($kls)." ".strtoupper($peminatan) ?> 
			<br>
			SMK BAKTI IDHATA
		</h4>
		<center>Jalan Melati No. 25, RT.13/RW.10, Cilandak Barat, Cilandak, Jakarta Selatan</center>
		<br>
		<table border="1" cellpadding="5">
			<thead>
				<tr>
					<th rowspan="3">No.</th>
					<th rowspan="3">NIS</th>
					<th rowspan="3">Nama Siswa</th>
					<?php 
						if ($rowmn>0) {
							$rowmn2=$rowmn*2;
							echo '<th colspan="'.$rowmn2.'">Muatan Nasional</th>';
						}											
						if ($rowml>0) {
							$rowml2=$rowml*2;
							echo '<th colspan="'.$rowml2.'">Muatan Lokal</th>';
						}	
						if ($rowmp>0) {									
							$rowmp2=$rowmp*2;
							echo '<th colspan="'.$rowmp2.'">Muatan Peminatan Kejuruan</th>';
						}
					?>											
					<th colspan="3">Absensi</th>
					<th rowspan="3" class="rotate"><div class="rotate">Jumlah NA P</div></th>
					<th rowspan="3" class="rotate"><div class="rotate">Jumlah NA K</div></th>
					<th rowspan="3" class="rotate"><div class="rotate">Rangking Nilai Pengetahuan</div></th>
					<th rowspan="3" class="rotate"><div class="rotate">Rangking Nilai Keterampilan</div></th>
					<!-- 											<th rowspan="3" class="rotate"><div class="rotate">Rangking Pengetahuan</div></th>
					<th rowspan="3" class="rotate"><div class="rotate">Rangking Keterampilan</div></th> -->
				</tr>	
				<tr>	
					<?php											
						//nama MP
						//nasional
						while ($datan=mysqli_fetch_array($resultmn)) {
							if (($datan['nama_mp']=='Pendidikan Agama Islam')||($datan['nama_mp']=='Pendidikan Agama Kristen')||($datan['nama_mp']=='Pendidikan Agama Katholik')||($datan['nama_mp']=='Pendidikan Agama Hindu')||($datan['nama_mp']=='Pendidikan Agama Buddha')||($datan['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
								echo '<th colspan="2" class="rotate"><div class="rotate">Pendidikan Agama</div></th>';
							}else if (($datan['nama_mp']=='Kewarganegaraan')||($datan['nama_mp']=='PKN')) {
								echo '<th colspan="2" class="rotate"><div class="rotate">Pendidikan Kewarganegaraan</div></th>';
							}else{
								echo '<th colspan="2" class="rotate"><div class="rotate">'.$datan['nama_mp'].'</div></th>';
							} 	
						} 
						//lokal
						while ($datal=mysqli_fetch_array($resultml)) {
							echo '<th colspan="2" class="rotate"><div class="rotate">'.$datal['nama_mp'].'</div></th>';
						}
						//peminatan
						while ($datap=mysqli_fetch_array($resultmp)) {
							echo '<th colspan="2" class="rotate"><div class="rotate">'.$datap['nama_mp'].'</div></th>';
						}											
					?>											
					<th rowspan="2" class="rotate"><div class="rotate">Sakit</div></th>
					<th rowspan="2" class="rotate"><div class="rotate">Izin</div></th>
					<th rowspan="2" class="rotate"><div class="rotate">Alpha</div></th>
				</tr>	
				<tr>	
					<?php											
						//P&K
						//nasional
						while ($datan=mysqli_fetch_array($resultmn2)) {
							if (($datan['nama_mp']=='Pendidikan Agama Islam')||($datan['nama_mp']=='Pendidikan Agama Kristen')||($datan['nama_mp']=='Pendidikan Agama Katholik')||($datan['nama_mp']=='Pendidikan Agama Hindu')||($datan['nama_mp']=='Pendidikan Agama Buddha')||($datan['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
								echo '<th>P</th><th>K</th>';
							}else if (($datan['nama_mp']=='Kewarganegaraan')||($datan['nama_mp']=='PKN')) {
								echo '<th>P</th><th>K</th>';
							}else{
								echo '<th>P</th><th>K</th>';
							} 	
						} 
						//lokal
						while ($datal=mysqli_fetch_array($resultml2)) {
							echo '<th>P</th><th>K</th>';
						}
						//peminatan
						while ($datap=mysqli_fetch_array($resultmp2)) {
							echo '<th>P</th><th>K</th>';
						}											
					?>								
				</tr>
			</thead>
			<tbody>
			<!--tabel-->
				<?php
					$querytbl="select * from siswa, kelas_siswa where siswa.kode_siswa=kelas_siswa.kode_siswa and kelas_siswa.kode_kelas='$kk' order by siswa.nama_siswa";
					$resulttbl=mysqli_query($koneksi,$querytbl);
					$row=mysqli_num_rows($resulttbl);
					$i=1;
					while ($i <= $row) {	
					   	while ($datatbl=mysqli_fetch_array($resulttbl)) {
					   		$ks=$datatbl['kode_siswa'];
					   		echo "<tr>
					    		<td align='center'>".$i."</td>
					    		<td>".$datatbl['nis']."</td>
					    		<td>".$datatbl['nama_siswa']."</td>";
							//nilai			
							$querymn3="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and semester='$kodesmt' and nilai.kode_siswa='$ks' and muatan='Nasional'";
							$resultmn3=mysqli_query($koneksi,$querymn3);		
							//nasional
							$rowmn3=mysqli_num_rows($resultmn3);
							if ($rowmn3>0) {
								while ($datan=mysqli_fetch_array($resultmn3)) {
									if (($datan['nama_mp']=='Pendidikan Agama Islam')||($datan['nama_mp']=='Pendidikan Agama Kristen')||($datan['nama_mp']=='Pendidikan Agama Katholik')||($datan['nama_mp']=='Pendidikan Agama Hindu')||($datan['nama_mp']=='Pendidikan Agama Buddha')||($datan['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
										echo '<td align="center">'.$datan['nilai_peng'].'</td>
											<td align="center">'.$datan['nilai_keter'].'</td>';
									}else if (($datan['nama_mp']=='Kewarganegaraan')||($datan['nama_mp']=='PKN')) {
										echo '<td align="center">'.$datan['nilai_peng'].'</td>
											<td align="center">'.$datan['nilai_keter'].'</td>';
									}else{
										echo '<td align="center">'.$datan['nilai_peng'].'</td>
											<td align="center">'.$datan['nilai_keter'].'</td>';
									} 	
								} 
							} 
							//lokal
							$queryml3="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and semester='$kodesmt' and nilai.kode_siswa='$ks' and muatan='Lokal'";
							$resultml3=mysqli_query($koneksi,$queryml3);
							$rowml3=mysqli_num_rows($resultml3);
							if ($rowml3>0) {
								while ($datal=mysqli_fetch_array($resultml3)) {
									$data=mysqli_fetch_array($result);
									echo '<td align="center">'.$datal['nilai_peng'].'</td>
										<td align="center">'.$datal['nilai_keter'].'</td>';
								}
							}
							//peminatan
							$querymp3="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and semester='$kodesmt' and nilai.kode_siswa='$ks' and muatan='Peminatan Kejuruan'";
							$resultmp3=mysqli_query($koneksi,$querymp3);
							$rowmp3=mysqli_num_rows($resultmp3);
							if ($rowmp3>0) {
								while ($datap=mysqli_fetch_array($resultmp3)) {
									$query="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and semester='$kodesmt' and nilai.kode_siswa='$ks'";
									$result=mysqli_query($koneksi,$query);		
									$data=mysqli_fetch_array($result);
									echo '<td align="center">'.$datap['nilai_peng'].'</td>
										<td align="center">'.$datap['nilai_keter'].'</td>';
								}
							}
							//absensi
							$queryabs="select * from kehadiran where kode_kelas='$kk' and semester='$kodesmt' and kode_siswa='$ks'";
							$resultabs=mysqli_query($koneksi,$queryabs);
							while ($dataabs=mysqli_fetch_array($resultabs)) {
								echo '<td align="center">'.$dataabs['sakit'].'</td>
									<td align="center">'.$dataabs['izin'].'</td>
									<td align="center">'.$dataabs['alpha'].'</td>';
							}
							//jumlah NA
							$queryna="select sum(nilai_peng), sum(nilai_keter) from nilai where kode_kelas='$kk' and semester='$kodesmt' and kode_siswa='$ks'";
							$resultna=mysqli_query($koneksi,$queryna);
							while ($datana=mysqli_fetch_array($resultna)) {
								echo '<td>'.$datana['sum(nilai_peng)'].'</td>
									<td>'.$datana['sum(nilai_keter)'].'</td>';
							}	    		
							//rank p
							foreach ($rankp as $rp => $user1) {
							    if ($user1 == $ks) {
									$rank1 = $rp+1;
								    echo '<th>'.$rank1.'</th>';
							    }
							}
							//rank k
							foreach ($rankk as $rk => $user2) {
							    if ($user2 == $ks) {
									$rank2 = $rk+1;
								    echo '<th>'.$rank2.'</th>';
							    }
							}
				    		echo "</tr>";
							$i++;
	    		    	}
						//Jumlah Nilai
						echo '<tr>
							<th colspan="3">Jumlah Nilai</th>';
						//nasional
						while ($datan=mysqli_fetch_array($resultmn4)) {
							if (($datan['nama_mp']=='Pendidikan Agama Islam')||($datan['nama_mp']=='Pendidikan Agama Kristen')||($datan['nama_mp']=='Pendidikan Agama Katholik')||($datan['nama_mp']=='Pendidikan Agama Hindu')||($datan['nama_mp']=='Pendidikan Agama Buddha')||($datan['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, sum(nilai_peng), sum(nilai_keter) from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['sum(nilai_peng)'].'</th><th>'.$data['sum(nilai_keter)'].'</th>';
							}else if (($datan['nama_mp']=='Kewarganegaraan')||($datan['nama_mp']=='PKN')) {
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, sum(nilai_peng), sum(nilai_keter) from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['sum(nilai_peng)'].'</th><th>'.$data['sum(nilai_keter)'].'</th>';
							}else{
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, sum(nilai_peng), sum(nilai_keter) from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['sum(nilai_peng)'].'</th><th>'.$data['sum(nilai_keter)'].'</th>';
							} 	
						} 
						//lokal
						while ($datal=mysqli_fetch_array($resultml4)) {
							$datamp=$datal['nama_mp'];
							$query="select mpelajaran.*, nilai.*, sum(nilai_peng), sum(nilai_keter) from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Lokal' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
							$result=mysqli_query($koneksi,$query);
							$data=mysqli_fetch_array($result);
							echo '<th>'.$data['sum(nilai_peng)'].'</th><th>'.$data['sum(nilai_keter)'].'</th>';
						}
						//peminatan	
						while ($datap=mysqli_fetch_array($resultmp4)) {
							$datamp=$datap['nama_mp'];
							$query="select mpelajaran.*, nilai.*, sum(nilai_peng), sum(nilai_keter) from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Peminatan Kejuruan' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
							$result=mysqli_query($koneksi,$query);
							$data=mysqli_fetch_array($result);
							echo '<th>'.$data['sum(nilai_peng)'].'</th><th>'.$data['sum(nilai_keter)'].'</th>';
						}
						echo'</tr>';
						// Rerata
						echo '<tr>
							<th colspan="3">Nilai Rata-Rata</th>';
						//nasional
						while ($datan=mysqli_fetch_array($resultmn5)) {
							if (($datan['nama_mp']=='Pendidikan Agama Islam')||($datan['nama_mp']=='Pendidikan Agama Kristen')||($datan['nama_mp']=='Pendidikan Agama Katholik')||($datan['nama_mp']=='Pendidikan Agama Hindu')||($datan['nama_mp']=='Pendidikan Agama Buddha')||($datan['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, round(avg(nilai_peng),2) as ap, round(avg(nilai_keter),2) as ak from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['ap'].'</th><th>'.$data['ak'].'</th>';
							}else if (($datan['nama_mp']=='Kewarganegaraan')||($datan['nama_mp']=='PKN')) {
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, round(avg(nilai_peng),2) as ap, round(avg(nilai_keter),2) as ak from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['ap'].'</th><th>'.$data['ak'].'</th>';
							}else{
								$datamp=$datan['nama_mp'];
								$query="select mpelajaran.*, nilai.*, round(avg(nilai_peng),2) as ap, round(avg(nilai_keter),2) as ak from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Nasional' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
								$result=mysqli_query($koneksi,$query);
								$data=mysqli_fetch_array($result);
								echo '<th>'.$data['ap'].'</th><th>'.$data['ak'].'</th>';
							} 	
						} 
						//lokal
						while ($datal=mysqli_fetch_array($resultml5)) {
							$datamp=$datal['nama_mp'];
							$query="select mpelajaran.*, nilai.*, round(avg(nilai_peng),2) as ap, round(avg(nilai_keter),2) as ak from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Lokal' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
							$result=mysqli_query($koneksi,$query);
							$data=mysqli_fetch_array($result);
							echo '<th>'.$data['ap'].'</th><th>'.$data['ak'].'</th>';
						}
						//peminatan	
						while ($datap=mysqli_fetch_array($resultmp5)) {
							$datamp=$datap['nama_mp'];
							$query="select mpelajaran.*, nilai.*, round(avg(nilai_peng),2) as ap, round(avg(nilai_keter),2) as ak from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and nilai.kode_kelas='$kk' and mpelajaran.muatan='Peminatan Kejuruan' and mpelajaran.nama_mp='$datamp' and semester='$kodesmt'";
							$result=mysqli_query($koneksi,$query);
							$data=mysqli_fetch_array($result);
							echo '<th>'.$data['ap'].'</th><th>'.$data['ak'].'</th>';
						}
						echo'</tr>';
					}
				?>
			</tbody>
		</table>
	</body>
</html>