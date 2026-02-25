<?php
session_start();
include("koneksi.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <a href="login.php?role=admin">login admin</a>
    <a href="login.php?role=kasir">login kasir</a>
    <a href="login.php?role=owner">login owner</a>
</body>
</html>