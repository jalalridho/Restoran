<?php
    include '../Connection/Connection.php';
    session_start();
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $cek = mysqli_num_rows($query);
        if($cek > 0)
        {
            $data = mysqli_fetch_assoc($query);
            $_SESSION['login'] = $username;
            $_SESSION['nama'] = $data['Namauser'];
            if($data['level'] == 'waiter'){
                header("location:../Page/Waiter.php");
            }else if($data['level'] == 'admin'){
                header("location:../Page/Admin.php");
            }else if($data['level'] == 'kasir'){
                header("location:../Page/Kasir.php");
            }else if($data['level'] == 'owner'){
                header("location:../Page/Owner.php");
            }
        }else{
            header("location:../index.php");
        }
    }
?>
