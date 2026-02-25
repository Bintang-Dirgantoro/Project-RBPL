<?php
session_start();
include("koneksi.php");

if (isset($_GET['role'])) {
    $role_aktif = $_GET['role'];
} else {
    header("Location: dashboard.php");
    exit;
}
//kalo sama dengan nya itu 1 doang, di php itu artinya ngisi nilai
//kalau 2 atau 3 itu baru membandingkan, makanya tadi eror wkwk
    if ($role_aktif=='admin') {
        $judul="LOGIN ADMIN";
        $warna="green";
    } elseif ($role_aktif=='owner') {
        $judul="LOGIN OWNER";
        $warna="pink";
    } elseif ($role_aktif=='kasir') {
        $judul="LOGIN KASIR";
        $warna="blue";
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //'password' sama 'username' disini itu dia ngambil dari name yg ada di form html
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "select * from users where username = '$username' limit 1";

            $result = mysqli_query($konek, $query);
            if (mysqli_num_rows($result) === 0) {
                echo "<script> alert('Maaf username anda salah!') 
                window.location.href='login.php'; </script>";
                exit;
            }

            //ambil semua data(full 1 baris ujung ke ujung) dari hasil query awal untuk pencocokan password, biar sesuai sama username terinput
            $result2 = mysqli_fetch_assoc($result);


            //'pass' disini itu nama kolom di database 
            //jadi beda sama yang username sama password diatas itu
           if ($result2['pass'] === $password) {
            // pengecekan role di akun ini sesuai dengan pintu login yang dibuka/ngga
            if ($result2['role'] !== $role_aktif) {
                echo "<script> alert('Maaf, akun ini tidak punya akses untuk login sebagai $role_aktif!'); 
                window.location.href='login.php?role=$role_aktif'; </script>";
                exit;
            }

            // Kalau cocok, baru buat session dan arahkan ke halaman masing-masing
                $_SESSION['username'] = $result2['username'];
                $_SESSION['role'] = $result2['role']; // Simpan role di session juga buat jaga-jaga

                if ($result2['role'] === 'admin') {
                    header('Location: verifadmin.php');
                } elseif ($result2['role'] === 'kasir') {
                    header('Location: inputkasir.php');
                } elseif ($result2['role'] === 'owner') {
                    header('Location: omzetowner.php');
                }
                exit;
            } else {
                echo "<script> alert('Maaf password yang anda masukkan salah');
                window.location.href='login.php'; </script>";
                exit;
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $judul?></h1>

    <form action="" method="post">
        <label for="">Username</label><br>
        <input type="text" name="username">
        <br>
        <label for="">Password</label><br>
        <input type="password" name="password">
        <br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>