<?php
    include '../config.php';
    $kode=$_GET['kg'];
    $query="delete from guru where kode_guru='$kode'";
    $query2="delete from mpelajaran where kode_guru='$kode'";
    $query3="delete from nilai where kode_guru='$kode'";
    $result=mysqli_query($koneksi,$query);
    $result2=mysqli_query($koneksi,$query2);
    $result3=mysqli_query($koneksi,$query3);
    
    if($result&&$result2&&$result3){
        echo "<script type='text/javascript'>alert('berhasil hapus guru')</script>";
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-guru.php';</script>";
?>