<?php
    include '../config.php';
    $kode=$_GET['id'];
    $ks=$_GET['ks'];
    $smt=$_GET['smt'];
    $query="delete from ekskul_siswa where id='$kode'";
    $result=mysqli_query($koneksi,$query);
    if($result){
        echo "<script type='text/javascript'>alert('berhasil hapus ekskul')</script>";
    }else{
        echo "<script type='text/javascript'>alert('gagal')</script>";
    }
    echo "<script type='text/javascript'>window.location.href='editnilai.php?ks=".$ks."&&smt=".$smt."';</script>";
?>