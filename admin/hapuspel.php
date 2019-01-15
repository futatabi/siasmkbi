<?php
    include '../config.php';
    $kode=$_GET['kp'];
    $query="delete from mpelajaran where kode_mp='$kode'";
    $result=mysqli_query($koneksi,$query);
    $query2="delete from nilai where kode_mp='$kode'";
    $result2=mysqli_query($koneksi,$query2);
    
    if($result&&$result2){
        echo "<script type='text/javascript'>alert('berhasil hapus mata pelajaran')</script>";                            
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-pel.php';</script>";
?>