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
	session_start();
	include '../config.php';
	$smt=$_GET['smt'];
	$kodemp=$_GET['kmp'];
	if($_SESSION['status']!="gurump"){
		header("location:../loginguru.php");
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

	$user=$_SESSION['user'];
	$query="select * from guru where nip='$user'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_array($result);
	$nama=$data['nama_guru'];
	$kodeg=$data['kode_guru'];

	$query2="select * from mpelajaran, kelas where mpelajaran.kode_guru='$kodeg' and mpelajaran.kode_kelas=kelas.kode_kelas";
	$result2=mysqli_query($koneksi,$query2);

	$query3="select * from mpelajaran, kelas where mpelajaran.kode_kelas=kelas.kode_kelas and mpelajaran.kode_mp='$kodemp'";
	$result3=mysqli_query($koneksi,$query3);
	$data3=mysqli_fetch_array($result3);
	$kodekelas=$data3['kode_kelas'];
	$namamp=$data3['nama_mp'];
	//bobot
	$query4="select * from mpelajaran, nilai where mpelajaran.kode_kelas=nilai.kode_kelas and mpelajaran.kode_mp='$kodemp'";
	$result4=mysqli_query($koneksi,$query4);
	$data4=mysqli_fetch_array($result4);

	$queryta="select kode_kelas, tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$datata=mysqli_fetch_array($ta);
	$tampilkk=$datata['kode_kelas'];
	$tampilta=$datata['tahun_ajar'];

	$fileName1="Daftar_Nilai_".$namamp."-".$data3['kelas']."-".$data3['peminatan']."-".$kodesmt."-".$tampilta.".xls";
	header("Content-Disposition: attachment; filename=$fileName1");
	header("Content-Type: application/vnd.ms-excel");
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Laporan Nilai</title>
		<!--basic styles
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		-->
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
		-->
		<!--ace styles
		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		-->
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<style type="text/css">
			hr {
				border-width: 1px;
				border-color: black;
			}
			h1, h2, h3, h4, h5 {
				margin: 0;
			}
		</style>
	</head>
	<body>				
	<!--PAGE CONTENT BEGINS-->
		<h3 align="center">LAPORAN PENILAIAN MATA PELAJARAN 
			<?php 
				echo $mp=strtoupper($namamp) 
			?>
		</h3>
		<h4 align="center">KELAS 
			<?php 
				echo strtoupper($data3['kelas'])." ".strtoupper($data3['peminatan']) 
			?>
			<br>SEMESTER <?php echo strtoupper($kodesmt)." ".$tampilta  ?>
			<br>SMK BAKTI IDHATA
		</h4>
		<center>Jalan Melati No. 25, RT.13/RW.10, Cilandak Barat, Cilandak, Jakarta Selatan</center>
		<br>
		<table border="1">
			<thead>
				<tr>
					<th rowspan="3">No.</th>
					<th rowspan="3">NIS</th>
					<th rowspan="3">Nama Siswa</th>
					<th rowspan="3">JK</th>
					<th rowspan="3">Agama</th>
					<th colspan="19">Pengetahuan</th>	
					<th colspan="19">Keterampilan</th>	
					<th rowspan="3">UTS</th>
					<th rowspan="3">UAS</th>
					<th rowspan="3">NAP</th>
					<th rowspan="3">NAK</th>
				</tr>	
				<tr>	
					<th colspan="11">Nilai Tugas</th>	
					<th colspan="8">Nilai UH</th>	
					<th colspan="11">Nilai Tugas</th>	
					<th colspan="8">Nilai UH</th>	
				</tr>	
				<tr>	
					<th> 1</th>
					<th> 2</th>
					<th> 3</th>
					<th> 4</th>
					<th> 5</th>
					<th> 6</th>
					<th> 7</th>
					<th> 8</th>
					<th> 9</th>
					<th> 10</th>
					<th> Rata2</th>
					<th> 1</th>
					<th> 2</th>
					<th> 3</th>
					<th> 4</th>
					<th> 5</th>
					<th> 6</th>
					<th> 7</th>
					<th> Rata2</th>
					<th> 1</th>
					<th> 2</th>
					<th> 3</th>
					<th> 4</th>
					<th> 5</th>
					<th> 6</th>
					<th> 7</th>
					<th> 8</th>
					<th> 9</th>
					<th> 10</th>
					<th> Rata2</th>
					<th> 1</th>
					<th> 2</th>
					<th> 3</th>
					<th> 4</th>
					<th> 5</th>
					<th> 6</th>
					<th> 7</th>
					<th> Rata2</th>
				</tr>
			</thead>
			<tbody>
			<!--tabel-->
			<?php
				$querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg";
				$resulttbl=mysqli_query($koneksi,$querytbl);
				$row=mysqli_num_rows($resulttbl);
				$i=1;
				while ($i <= $row) {
					while ($datatbl=mysqli_fetch_array($resulttbl)) {
			    		echo "<tr>
				    		<td align='center'>".$i."</td>
				    		<td>".$datatbl['nis']."</td>
				    		<td>".$datatbl['nama_siswa']."</td>
				    		<td align='center'>".$datatbl['jk']."</td>
				    		<td>".$datatbl['agama']."</td>";
			    		//tgsp
			    		if ($datatbl['jum_tgs_peng']==0) {
				    		echo "<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>";
			    		}else{
							$j=1;
							$jtgsp=$datatbl['jum_tgs_peng'];
				    		while ($j <= $jtgsp) {
				    			echo "<td>".$datatbl['tgs_peng'.$j.'']."</td>";
					    		$j++;
					    	}
					    	while (10>$jtgsp) {
					    		echo "<td> </td>";
					    		$jtgsp++;
					    	}
					    	if ($datatbl['rerata_tgs_peng']!='0.00') {
					    		echo "<td>".$datatbl['rerata_tgs_peng']."</td>";
					    	}else{											   
					    		echo "<td> </td>";
					    	}
			    		}
				   		//uhp
				   		if ($datatbl['jum_uh_peng']==0) {
				    		echo "<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>";
				   		}else{
				   			$j=1;
				   			$juhp=$datatbl['jum_uh_peng'];
				    		while ($j <= $juhp) {
					    		echo "<td>".$datatbl['uh_peng'.$j.'']."</td>";
					    		$j++;
						    }
						    while (7>$juhp) {
						    	echo "<td> </td>";
						    	$juhp++;
						    }
						    if ($datatbl['rerata_uh_peng']!='0.00') {
						    	echo "<td>".$datatbl['rerata_uh_peng']."</td>";
						    }else{											   
						    	echo "<td> </td>";
						   	}
				    	}
					    //tgsk
					    if ($datatbl['jum_tgs_keter']==0) {
					    	echo "<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>";
			    		}else{
			    			$j=1;
			    			$jtgsk=$datatbl['jum_tgs_keter'];
						    while ($j <= $jtgsk) {
								echo "<td>".$datatbl['tgs_keter'.$j.'']."</td>";
								$j++;
							}
							while (10>$jtgsk) {
								echo "<td> </td>";
								$jtgsk++;
							}
							if ($datatbl['rerata_tgs_keter']!='0.00') {
					    		echo "<td>".$datatbl['rerata_tgs_keter']."</td>";
					    	}else{											   
					    		echo "<td> </td>";
					    	}
				    	}
				    	//uhk
				    	if ($datatbl['jum_uh_keter']==0) {
				    		echo "<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>
				    			<td> </td>";
				    	}else{
				    		$j=1;
				    		$juhk=$datatbl['jum_uh_keter'];
				    		while ($j <= $juhk) {
				    			echo "<td>".$datatbl['uh_keter'.$j.'']."</td>";
				    			$j++;
					    	}
					    	while (7>$juhk) {
								echo "<td> </td>";
								$juhk++;
							}
							if ($datatbl['rerata_uh_keter']!='0.00') {
								echo "<td>".$datatbl['rerata_uh_keter']."</td>";
							}else{											   
								echo "<td> </td>";
					    	}
			    		}
			    		echo "<td>".$datatbl['uts']."</td>";
			    		echo "<td>".$datatbl['uas']."</td>";
			    		echo "<td>".$datatbl['nilai_peng']."</td>";
			    		echo "<td>".$datatbl['nilai_keter']."</td>";
			    		echo "</tr>";
			    	   	$i++;
					}
				}
			?>
			</tbody>
		</table>
	</body>
</html>