<?php 
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
	$html ='<html>
			<head>
				<meta charset="utf-8" />
				<title>Laporan Nilai</title>
				<style type="text/css">
					table, th, tr, td {
						border: 1px solid black;
						border-collapse: collapse;
					}
					hr {
						border-width: 1px;
						border-color: black;
					}
					h1, h2, h3, h4, h5 {
						margin: 0;
					}
				</style>
			</head>
			<body>';		
	$html .='<h3 align="center">LAPORAN PENILAIAN MATA PELAJARAN '.$mp=strtoupper($namamp).'
			</h3>
			<h4 align="center">KELAS '.strtoupper($data3['kelas']).' '.strtoupper($data3['peminatan']).'<br>
				SEMESTER '.strtoupper($kodesmt).' '.$tampilta.'<br>
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
				<tbody>';
		$querytbl="select * from siswa, kelas_siswa, nilai where siswa.kode_siswa=kelas_siswa.kode_siswa and siswa.kode_siswa=nilai.kode_siswa and kelas_siswa.kode_kelas=$kodekelas and nilai.kode_kelas=$kodekelas and nilai.semester='$kodesmt' and nilai.kode_guru=$kodeg";
		$resulttbl=mysqli_query($koneksi,$querytbl);
		$row=mysqli_num_rows($resulttbl);
		$i=1;
		while ($i <= $row) {
			while ($datatbl=mysqli_fetch_array($resulttbl)) {
				$html .='<tr>
			    		<td align="center">'.$i.'</td>
			    		<td>'.$datatbl['nis'].'</td>
			    		<td>'.$datatbl['nama_siswa'].'</td>
			    		<td align="center">'.$datatbl['jk'].'</td>
			    		<td>'.$datatbl['agama'].'</td>';
			    //tgsp
			    if ($datatbl['jum_tgs_peng']==0) {
			    	$html .='<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>';
				}else{
	    			$j=1;
	    			$jtgsp=$datatbl['jum_tgs_peng'];
		    		while ($j <= $jtgsp) {
			    		$html .='<td>'.$datatbl['tgs_peng'.$j.''].'</td>';
			    		$j++;
			    	}
			    	while (10>$jtgsp) {
				    	$html .='<td> </td>';
			    		$jtgsp++;
			    	}
			    	if ($datatbl['rerata_tgs_peng']!='0.00') {
				    	$html .='<td>'.$datatbl['rerata_tgs_peng'].'</td>';
			    	}else{											   
				    	$html .='<td> </td>';
			    	}
	    		}
				//uhp
				if ($datatbl['jum_uh_peng']==0) {
					$html .='<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>';
	    		}else{
	    			$j=1;
	    			$juhp=$datatbl['jum_uh_peng'];
		    		while ($j <= $juhp) {
			    		$html .='<td>'.$datatbl['uh_peng'.$j.''].'</td>';
			    		$j++;
			    	}
			    	while (7>$juhp) {
				    	$html .='<td> </td>';
			    		$juhp++;
			    	}
			    	if ($datatbl['rerata_uh_peng']!='0.00') {
				    	$html .='<td>'.$datatbl['rerata_uh_peng'].'</td>';
			    	}else{											   
				    	$html .='<td> </td>';
			    	}
				}
			    //tgsk
				if ($datatbl['jum_tgs_keter']==0) {
		    		$html .='<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>
		    			<td> </td>';
		    	}else{
		    		$j=1;
		    		$jtgsk=$datatbl['jum_tgs_keter'];
		    		while ($j <= $jtgsk) {
			    		$html .='<td>'.$datatbl['tgs_keter'.$j.''].'</td>';
			    		$j++;
			    	}
			    	while (10>$jtgsk) {
			    		$html .='<td> </td>';
			    		$jtgsk++;
			    	}
			    	if ($datatbl['rerata_tgs_keter']!='0.00') {
			    		$html .='<td>'.$datatbl['rerata_tgs_keter'].'</td>';
			    	}else{											   
			    		$html .='<td> </td>';
			    	}
	    		}
	    		//uhk
	    		if ($datatbl['jum_uh_keter']==0) {
		    		$html .='<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>
			    			<td> </td>';
	    		}else{
			    	$j=1;
			    	$juhk=$datatbl['jum_uh_keter'];
			    	while ($j <= $juhk) {
			    		$html .='<td>'.$datatbl['uh_keter'.$j.''].'</td>';
			    		$j++;
				    }
				    while (7>$juhk) {
				    	$html .='<td> </td>';
				    	$juhk++;
				    }
				    if ($datatbl['rerata_uh_keter']!='0.00') {
				    	$html .='<td>'.$datatbl['rerata_uh_keter'].'</td>';
				    }else{											   
				    	$html .='<td> </td>';
				    }
	    		}
	    		$html .='<td>'.$datatbl['uts'].'</td>
		    			<td>'.$datatbl['uas'].'</td>
		    			<td>'.$datatbl['nilai_peng'].'</td>
		    			<td>'.$datatbl['nilai_keter'].'</td>
	    			</tr>';
			    $i++;
			}
		}
		$html .='</tbody>
				</table>
			</body>
		</html>';
	require_once("../assets/dompdf/autoload.inc.php");
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);
	$dompdf->set_paper('A3','landscape');
	$dompdf->render();
	$dompdf->stream('Laporan Nilai '.$namamp.' Kelas '.$data3['kelas'].' '.$data3['peminatan'].' Semester '.$kodesmt.' '.$tampilta.'.pdf');
?>