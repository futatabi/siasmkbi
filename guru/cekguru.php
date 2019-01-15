<?php
    session_start();
    include '../config.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="select * from guru where nip='$user' and pass='$pass'";

    $result=mysqli_query($koneksi,$query);
    $data=mysqli_fetch_array($result);
    $row=mysqli_num_rows($result);
    
    if($row==1){
        $_SESSION['user']=$data['nip'];
        $_SESSION['status']="gurump";
        header("location:guru.php");
    }else{
        echo "<script>alert('Maaf, username atau password salah');window.open('../loginguru.php','_self');</script>";
    }
?>