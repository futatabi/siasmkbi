<?php
    include '../config.php';
    $kode=$_GET['kk'];
    $query="delete from kelas where kode_kelas='$kode'";
    $result=mysqli_query($koneksi,$query);
    
    if($result){
        echo "<script type='text/javascript'>alert('berhasil hapus kelas')</script>";
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-kelas.php';</script>";
?>