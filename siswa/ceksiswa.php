<?php
    session_start();
    include '../config.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="select * from siswa where nis='$user' and pass='$pass'";

    $result=mysqli_query($koneksi,$query);
    $data=mysqli_fetch_array($result);
    $row=mysqli_num_rows($result);
    
    if($row==1){
        $_SESSION['user']=$data['nis'];
        $_SESSION['status']="siswa";
        header("location:siswa.php");
    }else{
        echo "<script>alert('Maaf, username atau password salah');window.open('../index.php','_self');</script>";
    }
?>