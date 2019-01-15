<?php 
	$si=$_POST['sikap'];
	if ($smt==01) {
		$querysi="update nilai set sikap_ga='$si' where id='$kode'";
	}else{
		$querysi="update nilai set sikap_ge='$si' where id='$kode'";
	}
	$resultsi=mysqli_query($koneksi,$querysi);
?>