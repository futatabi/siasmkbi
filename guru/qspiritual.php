<?php 
	$spi=$_POST['spiritual'];
	if ($smt==01) {
		$queryspi="update nilai set spiritual_ga='$spi' where id='$kode'";
	}else{
		$queryspi="update nilai set spiritual_ge='$spi' where id='$kode'";
	}
	$resultspi=mysqli_query($koneksi,$queryspi);
?>