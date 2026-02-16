<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'projectrbpl';

$konek = new mysqli($hostname, $username, $password, $database);
if ($konek->connect_error) {
    die("maaf koneksi gagal".$konek->connect_error);
}
?>