<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';

$db = new database();
$db->connect(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $umur = $_POST["umur"];

    $db->simpan($nama, $alamat, $umur);
}
?>
