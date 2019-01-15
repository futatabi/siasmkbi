<?php
    include '../config.php';
    $kode=$_GET['ke'];
    $query="delete from ekskul where kode_ekskul='$kode'";
    $result=mysqli_query($koneksi,$query);
    
    if($result){
        echo "<script type='text/javascript'>alert('berhasil hapus ekskul')</script>";
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-ekskul.php';</script>";
?>