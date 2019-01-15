<?php
    include '../config.php';
    $kode=$_GET['ks'];
    $query="delete from siswa where kode_siswa='$kode'";
    $query2="delete from kelas_siswa where kode_siswa='$kode'";
    $query3="delete from nilai where kode_siswa='$kode'";
    $query4="delete from ekskul_siswa where kode_siswa='$kode'";
    $query5="delete from prakerin where kode_siswa='$kode'";
    $query6="delete from prestasi where kode_siswa='$kode'";
    $result=mysqli_query($koneksi,$query);
    $result2=mysqli_query($koneksi,$query2);
    $result3=mysqli_query($koneksi,$query3);
    $result4=mysqli_query($koneksi,$query4);
    $result5=mysqli_query($koneksi,$query5);
    $result6=mysqli_query($koneksi,$query6);
    
    if($result&&$result2&&$result3){
        echo "<script type='text/javascript'>alert('berhasil hapus siswa')</script>";
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-siswa.php';</script>";
?>