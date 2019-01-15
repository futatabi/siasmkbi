<?php
	// session_start();
	// include '../config.php';
	// $smt=$_GET['smt'];
	// $kk=$_GET['kk'];
	// $ks=$_GET['ks'];
	if($_SESSION['status']!="walikelas"){
		header("location:../loginwali.php");
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
	}

	$queryta="select kelas, peminatan, tahun_ajar from kelas where kode_kelas='$kk'";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$kls=$datata['kelas'];
	$peminatan=$datata['peminatan'];
	$tampilta=$datata['tahun_ajar'];

	$query="select * from siswa where kode_siswa='$ks'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_array($result);
	$nsiswa=$data['nama_siswa'];
	$nis=$data['nis'];
	$nisn=$data['nisn'];
	$agm=$data['agama'];

	// $querytbl="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' order by field(muatan, 'Nasional', 'Lokal', 'Peminatan Kejuruan')";
	// $resulttbl=mysqli_query($koneksi,$querytbl);
	// $row=mysqli_num_rows($resulttbl);
	//spirit
	if ($agm=='Islam') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Islam'";
	}else if ($agm=='Kristen') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Kristen'";
	}else if ($agm=='Katholik') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Katholik'";
	}else if ($agm=='Hindu') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Hindu'";
	}else if ($agm=='Buddha') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Buddha'";
	}else if ($agm=='Kong Hu Cu') {
		$query1="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='Pendidikan Agama Kong Hu Cu'";
	}
	$result1=mysqli_query($koneksi,$query1);
	$data1=mysqli_fetch_array($result1);
	//sosial
	$query2="select * from siswa, mpelajaran, nilai where siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and nama_mp='PKN'";
	$result2=mysqli_query($koneksi,$query2);
	$data2=mysqli_fetch_array($result2);
	//eksul
	$query3="select * from ekskul, ekskul_siswa where ekskul.kode_ekskul=ekskul_siswa.kode_ekskul and ekskul_siswa.kode_siswa='$ks' and ekskul_siswa.kode_kelas='$kk'";
	$result3=mysqli_query($koneksi,$query3);
	//prakerin
	$query4="select * from prakerin where kode_siswa='$ks' and kode_kelas='$kk'";
	$result4=mysqli_query($koneksi,$query4);
	//pres
	$query5="select * from prestasi where kode_siswa='$ks' and kode_kelas='$kk'";
	$result5=mysqli_query($koneksi,$query5);
	//hadir
	$query6="select * from kehadiran where kode_siswa='$ks' and kode_kelas='$kk' and semester='$kodesmt'";
	$result6=mysqli_query($koneksi,$query6);
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Laporan Rapor</title>
		<style type="text/css">
			hr {
				border-width: 1px;
				border-color: black;
			}
			h1, h2, h3, h4, h5 {
				margin: 0;
			}
			.border {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>				
	<!--PAGE CONTENT BEGINS-->
		<table>
			<tr>
				<td>Nama Sekolah</td>
				<td>: SMK Bakti Idhata</td>
				<td width="90px"> </td>
				<td>Kelas</td>
				<td>: <?php echo $kls ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: Jalan Melati No. 25, RT.13/RW.10, Cilandak Barat, Cilandak, Jakarta Selatan</td>
				<td></td>
				<td>Kompetensi Keahlian</td>
				<td>: <?php echo $peminatan ?></td>
			</tr>
			<tr>
				<td>Nama Peserta Didik</td>
				<td>: <?php echo $nsiswa ?></td>
				<td></td>
				<td>Semester</td>
				<td>: <?php echo $kodesmt ?></td>
			</tr>
			<tr>
				<td>No. Induk/NISN</td>
				<td>: <?php echo $nis."/".$nisn ?></td>
				<td></td>
				<td>Tahun Ajaran</td>
				<td>: <?php echo $tampilta ?></td>
			</tr>
		</table>
		<br>
		<h3>Capaian Hasil Belajar</h3>
		<br>
		<table cellpadding="5" width="98%">
			<tr>
				<th>A.</th>
				<th align="left">Sikap Spiritual</th>
			</tr>
			<tr>
				<td></td>
				<td class="border" width="100%">Deskripsi :<br><?php echo $data1[$spiritual]; ?> <br><br></td>
			</tr>
			<tr>
				<th>B.</th>
				<th align="left">Sikap Sosial</th>
			</tr>
			<tr>
				<td></td>
				<td class="border" width="100%">Deskripsi :<br><?php echo $data2[$sikap]; ?> <br><br></td>
			</tr>
			<tr>
				<th>C.</th>
				<th align="left">Pengetahuan dan Keterampilan</th>
			</tr>
		</table>							
		<!-- //P&K -->
		<table cellpadding="5" style="margin-left: 30px; width: 95%" class="border" border="1">
			<tr >
				<th rowspan="2" width="5px">No.</th>
				<th rowspan="2">Mata Pelajaran</th>
				<th colspan="4">Pengetahuan</th>
				<th colspan="4">Keterampilan</th>
			</tr>
			<tr>
				<th width="1">KKM</th>
				<th width="1">Angka</th>
				<th width="1">Predikat</th>
				<th width="20%">Deskripsi</th>
				<th width="1">KKM</th>
				<th width="1">Angka</th>
				<th width="1">Predikat</th>
				<th width="20%">Deskripsi</th>
			</tr>
			<?php 
			    echo "<tr><td colspan='10'>Muatan Nasional</td></tr>";
				$querymn="select * from siswa, kelas_siswa, mpelajaran, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=kelas_siswa.kode_kelas and kelas_siswa.kode_kelas='$kk' and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and muatan='Nasional'";
				$resultmn=mysqli_query($koneksi,$querymn);
				$i=1;
				while ($datamn=mysqli_fetch_array($resultmn)){
					echo "<tr><td align='center'>".$i."</td>";
					if (($datamn['nama_mp']=='Pendidikan Agama Islam')||($datamn['nama_mp']=='Pendidikan Agama Kristen')||($datamn['nama_mp']=='Pendidikan Agama Katholik')||($datamn['nama_mp']=='Pendidikan Agama Hindu')||($datamn['nama_mp']=='Pendidikan Agama Buddha')||($datamn['nama_mp']=='Pendidikan Agama Kong Hu Cu')) {
						$nilaip=$datamn['nilai_peng'];
						$nilaik=$datamn['nilai_keter'];
						if ($nilaip>85&&$nilaip<=100) {
							$prep="A";
						}else if ($nilaip>70&&$nilaip<=85) {
							$prep="B";
						}else if ($nilaip>55&&$nilaip<=70) {
							$prep="C";
						}else if ($nilaip<=55){
							$prep="D";
						}
						if ($nilaik>85&&$nilaik<=100) {
							$prek="A";
						}else if ($nilaik>70&&$nilaik<=85) {
							$prek="B";
						}else if ($nilaik>55&&$nilaik<=70) {
							$prek="C";
						}else if ($nilaik<=55){
							$prek="D";
						}
						echo "<td>Pendidikan Agama</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaip."</td>
							<td align='center'>".$prep."</td>
							<td>".$datamn[$desp]."</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaik."</td>
							<td align='center'>".$prek."</td>
							<td>".$datamn[$desk]."</td>
						</tr>";
					}else if (($datamn['nama_mp']=='Kewarganegaraan')||($datamn['nama_mp']=='PKN')) {
						$nilaip=$datamn['nilai_peng'];
						$nilaik=$datamn['nilai_keter'];
						if ($nilaip>85&&$nilaip<=100) {
							$prep="A";
						}else if ($nilaip>70&&$nilaip<=85) {
							$prep="B";
						}else if ($nilaip>55&&$nilaip<=70) {
							$prep="C";
						}else if ($nilaip<=55){
							$prep="D";
						}
						if ($nilaik>85&&$nilaik<=100) {
							$prek="A";
						}else if ($nilaik>70&&$nilaik<=85) {
							$prek="B";
						}else if ($nilaik>55&&$nilaik<=70) {
							$prek="C";
						}else if ($nilaik<=55){
							$prek="D";
						}
						echo "<td>Pendidikan Pancasila dan Kewarganegaraan</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaip."</td>
							<td align='center'>".$prep."</td>
							<td>".$datamn[$desp]."</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaik."</td>
							<td align='center'>".$prek."</td>
							<td>".$datamn[$desk]."</td>
						</tr>";
					}else{
						$nilaip=$datamn['nilai_peng'];
						$nilaik=$datamn['nilai_keter'];
						if ($nilaip>85&&$nilaip<=100) {
							$prep="A";
						}else if ($nilaip>70&&$nilaip<=85) {
							$prep="B";
						}else if ($nilaip>55&&$nilaip<=70) {
							$prep="C";
						}else if ($nilaip<=55){
							$prep="D";
						}
						if ($nilaik>85&&$nilaik<=100) {
							$prek="A";
						}else if ($nilaik>70&&$nilaik<=85) {
							$prek="B";
						}else if ($nilaik>55&&$nilaik<=70) {
							$prek="C";
						}else if ($nilaik<=55){
							$prek="D";
						}
						echo "<td>".$datamn['nama_mp']."</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaip."</td>
							<td align='center'>".$prep."</td>
							<td>".$datamn[$desp]."</td>
							<td align='center'>".$datamn['kkm']."</td>
							<td align='center'>".$nilaik."</td>
							<td align='center'>".$prek."</td>
							<td>".$datamn[$desk]."</td>
						</tr>";
					}
					$i++; 	
				}
			    echo "<tr><td colspan='10'>Muatan Lokal</td></tr>";
				$queryml="select * from siswa, kelas_siswa, mpelajaran, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=kelas_siswa.kode_kelas and kelas_siswa.kode_kelas='$kk' and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and muatan='Lokal'";
				$resultml=mysqli_query($koneksi,$queryml);
				$j=1;
				while ($dataml=mysqli_fetch_array($resultml)){
					echo "<tr><td align='center'>".$j."</td>";
					echo "<td>".$dataml['nama_mp']."</td>
						<td align='center'>".$dataml['kkm']."</td>
						<td align='center'>".$nilaip."</td>
						<td align='center'>".$prep."</td>
						<td>".$dataml[$desp]."</td>
						<td align='center'>".$dataml['kkm']."</td>
						<td align='center'>".$nilaik."</td>
						<td align='center'>".$prek."</td>
						<td>".$dataml[$desk]."</td>
					</tr>";
					$j++;
				}
			    echo "<tr><td colspan='10'>Muatan Peminatan Kejuruan</td></tr>";
				$querymp="select * from siswa, kelas_siswa, mpelajaran, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and mpelajaran.kode_kelas=kelas_siswa.kode_kelas and kelas_siswa.kode_kelas='$kk' and mpelajaran.kode_mp=nilai.kode_mp and semester='$kodesmt' and siswa.kode_siswa='$ks' and muatan='Peminatan Kejuruan'";
				$resultmp=mysqli_query($koneksi,$querymp);
				$k=1;
				while ($datamp=mysqli_fetch_array($resultmp)){
					echo "<tr><td align='center'>".$k."</td>";
					echo "<td>".$datamp['nama_mp']."</td>
						<td align='center'>".$datamp['kkm']."</td>
						<td align='center'>".$nilaip."</td>
						<td align='center'>".$prep."</td>
						<td>".$datamp[$desp]."</td>
						<td align='center'>".$datamp['kkm']."</td>
						<td align='center'>".$nilaik."</td>
						<td align='center'>".$prek."</td>
						<td>".$datamp[$desk]."</td>
					</tr>";
					$k++;
				}
			?>
		</table>
		<table cellpadding="5">
			<tr>
				<th>D.</th>
				<th align="left">Ekstra Kurikuler</th>
			</tr>
		</table>							
		<table cellpadding="5" style="margin-left: 30px; width: 70%" class="border" border="1">
			<tr>
				<th width="5px">No.</th>
				<th>Kegiatan</th>
				<th>Keterangan Nilai</th>
			</tr>
			<?php
				$i=1;
				while ($data3=mysqli_fetch_array($result3)) {
					$nilaie=$data3['nilai_ekskul'];
					if ($nilaie>85&&$nilaie<=100) {
						$kne="Sangat Baik";
					}else if ($nilaie>70&&$nilaie<=85) {
						$kne="Baik";
					}else if ($nilaie>55&&$nilaie<=70) {
						$kne="Cukup";
					}else if ($nilaie<=55){
						$kne="Kurang";
					}
					echo '<tr><td align="center">'.$i.'</td>';
					echo '<td>'.$data3['nama_ekskul'].'</td>';
					echo '<td align="center">'.$kne.'</td></tr>';
					$i++;
				}
			?>
		</table>
		<table cellpadding="5">
			<tr>
				<th>E.</th>
				<th align="left">Praktek Kerja Lapangan</th>
			</tr>
		</table>							
		<table cellpadding="5" style="margin-left: 30px; width: 70%" class="border" border="1">
			<tr >
				<th>Tempat Praktek</th>
				<th>Lokasi</th>
				<th>Keterangan Nilai</th>
			</tr>
			<?php
				$data4=mysqli_fetch_array($result4);
				if ($data4['tempat']==null) {
					echo '<tr><td align="center">-</td><td align="center">-</td><td align="center">-</td></tr>';
				}else{
					$nilaipra=$data4['nilai'];
					if ($nilaipra>85&&$nilaipra<=100) {
						$knp="Sangat Baik";
					}else if ($nilaipra>70&&$nilaipra<=85) {
						$knp="Baik";
					}else if ($nilaipra>55&&$nilaipra<=70) {
						$knp="Cukup";
					}else if ($nilaipra<=55){
						$knp="Kurang";
					}
					echo '<tr><td>'.$data4['tempat'].'</td>';
					echo '<td>'.$data4['alamat'].'</td>';
					echo '<td align="center">'.$knp.'</td></tr>';
				}
			?>
		</table>
		<table cellpadding="5">
			<tr>
				<th>F.</th>
				<th align="left">Prestasi</th>
			</tr>
		</table>							
		<table cellpadding="5" style="margin-left: 30px; width: 70%" class="border" border="1">
			<tr >
				<th width="5px">No.</th>
				<th>Jenis Prestasi</th>
				<th>Keterangan</th>
			</tr>
			<?php
				$i=1;
				if ($row5=mysqli_num_rows($result5)==0) {
					echo '<tr><td align="center">-</td><td align="center">-</td><td align="center">-</td></tr>';
				}else{
					while ($data5=mysqli_fetch_array($result5)) {
						echo '<tr><td align="center">'.$i.'</td>';
						echo '<td>'.$data5['prestasi'].'</td>';
						echo '<td>'.$data5['keterangan'].'</td></tr>';
						$i++;
					}
				}
			?>
		</table>
		<table cellpadding="5">
			<tr>
				<th>G.</th>
				<th align="left">Ketidakhadiran</th>
			</tr>
		</table>							
		<table cellpadding="5" style="margin-left: 30px; width: 40%" class="border" border="1">
			<?php
				while ($data6=mysqli_fetch_array($result6)) {
					echo '<tr><td>Sakit</td>';
					echo '<td align="center">'.$data6['sakit'].' hari</td></tr>';
					echo '<tr><td>Izin</td>';
					echo '<td align="center">'.$data6['izin'].' hari</td></tr>';
					echo '<tr><td>Tanpa Keterangan</td>';
					echo '<td align="center">'.$data6['alpha'].' hari</td></tr>';
				}
			?>
		</table>
		<table cellpadding="5" width="98%">
			<tr>
				<th>H.</th>
				<th align="left">Catatan Wali Kelas</th>
			</tr>
			<tr>
				<td></td>
				<td class="border" width="100%">
					<?php 
						echo $data1['deskripsi'] 
					?>
					<br>
					<br>
				</td>
			</tr>
			<tr>
				<th>I.</th>
				<th align="left">Tanggapan Orang Tua / Wali</th>
			</tr>
			<tr>
				<td></td>
				<td class="border" width="100%"><br><br><br></td>
			</tr>
		</table>
		<br>
		<br>
		<?php
			if ($smt==01) {
		?>
		<table style="padding: 20px" cellpadding="5" width="100%">
			<tr>
				<td align="center">
					Jakarta, 
					<?php				
						function tgl($tanggal){
							$bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
							$pecah=explode('-', $tanggal);
							return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
						}
						echo tgl(date('Y-m-d'));
					?>
				<br>
				Orangtua / Wali<br><br><br><br><br>
				________________
				</td>
				<td></td>
				<td align="center">
				<br>Wali Kelas<br><br><br><br><br>
				________________
				</td>
			</tr>
			<tr>
				<td></td>			
				<td align="center">
					Mengetahui,<br>
					Kepala SMK Bakti Idhata<br><br><br><br><br><br>

					_____________________
				</td>			
				<td></td>			
			</tr>
		</table>
		<?php	
			}else{
		?>
		<table style="padding: 20px; margin-top: 30px" cellpadding="10" width="95%">
			<tr>
				<td align="center">
				<br>Wali Kelas<br><br><br><br><br>
				________________
				<br><br><br><br>
				Orangtua / Wali<br><br><br><br><br>
				________________
				</td>
				<td width="20%"></td>
				<td class="border" width="40%">
					<strong>Keputusan :</strong><br>
					Berdasarkan hasil yang dicapai pada semester ganjil dan genap,<br>
					peserta didik ditetapkan<br>
					naik ke kelas _____(______________)<br>
					tinggal di kelas _____(______________)<br><br>
					Jakarta, 
					<?php				
						function tgl($tanggal){
							$bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
							$pecah=explode('-', $tanggal);
							return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
						}
						echo tgl(date('Y-m-d'));
					?>
					<br>
					Kepala SMK Bakti Idhata<br><br><br><br><br><br>

					_____________________<br>
				</td>
			</tr>
		</table>
		<?php
			}
		?>
	</body>
</html>