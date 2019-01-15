<?php
    include '../config.php';
    $kode=$_GET['kw'];
    $query="delete from walikelas where kode_wali='$kode'";
    $result=mysqli_query($koneksi,$query);
    
    if($result){
        echo "<script type='text/javascript'>alert('berhasil hapus wali kelas')</script>";                  
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    
    echo "<script type='text/javascript'>window.location.href='admin-wk.php';</script>";
?>