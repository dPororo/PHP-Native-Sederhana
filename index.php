<?php
include 'database.php';
$db = new database();
$conn = $db->connect();

$stmt = $db->tampil();
$data_mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
    $alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
    $usia = isset($_POST["usia"]) ? $_POST["usia"] : "";

    if (!empty($nama) && !empty($alamat) && !empty($usia)) {
        $db->simpan($nama, $alamat, $usia);

        $stmt = $db->tampil();
        $data_mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


if (isset($_POST['hapus'])) {
    $id = $_POST['hapus'];
    $db->hapus($id);

    $stmt = $db->tampil();
    $data_mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="input.php">Input Data</a>
    <table border="1">
        <thead align="center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Usia</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $index = 1;
        foreach ($data_mahasiswa as $mahasiswa) {
            echo "<tr>";
            echo "<td>$index</td>";
            echo "<td>{$mahasiswa['nama']}</td>";
            echo "<td>{$mahasiswa['alamat']}</td>";
            echo "<td>{$mahasiswa['umur']}</td>";
            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='hapus' value='{$mahasiswa['id']}'>";
            echo "<button type='submit'>Hapus</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
            $index++;
        }
        ?>
        </tbody>
    </table>
    <br>
</body>
</html>
