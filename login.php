<?php
session_start();
include("koneksi.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
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

            $result2 = mysqli_fetch_assoc($result);
            //disini result2 itu megang data keseluruhan dari username terinput user
            //jadi alurnya user input username, baru dicari secara global sama query, ada atau gak
            //baru setelah ada, maka pake fetch assoc buat nyimpn yang udah di dapet ke result2
            //baru deh datanya kepegang dan bisa dipake, karna di $result itu cuma bisa diliat doang
            //kalo cuma bisa diliat maka gabisa dipanggil password yang terkait sama username terinput
            if ($result2['password'] === $password) {
                $_SESSION['username'] = $result2['username'];
                //disini username yang ada di data result2 itu disimpen ke session
                //biar php inget dan bisa ngejalanin cek login untuk semua page
                //biar untuk masuk ke page page tertentu ya harus login dulu, ga asal masuk
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
    <form action="" method="post">
        <label for="">Username</label><br>
        <input type="text" name="username" placeholder="username">
        <br>
        <label for="">Password</label>
        <input type="password" name="password" placeholder="password">
        <br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>