<?php
    session_start();
    include '../config.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="select * from administrator where user='$user' and pass='$pass'";

    $result=mysqli_query($koneksi,$query);
    $row=mysqli_num_rows($result);
    $data=mysqli_fetch_array($result);

    if($row==1){
        $useradm=$data['user'];
        $_SESSION['user']=$useradm;
        $_SESSION['status']="administrator";
        header("location:admin.php");
    }else{
        echo "<script>alert('Maaf, username atau password salah');window.open('../loginadm.php','_self');</script>";
    }
?>