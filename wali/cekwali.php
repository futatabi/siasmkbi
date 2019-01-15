<?php
    session_start();
    include '../config.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="select * from walikelas where user_wali='$user' and pass='$pass'";

    $result=mysqli_query($koneksi,$query);
    $data=mysqli_fetch_array($result);
    $row=mysqli_num_rows($result);
    
    if($row==1){
        $_SESSION['user']=$data['user_wali'];
        $_SESSION['status']="walikelas";
        header("location:wali.php");
    }else{
        echo "<script>alert('Maaf, username atau password salah');window.open('../loginwali.php','_self');</script>";
    }
?>