<?php
class database {
    private $host = "localhost";
    private $dbname = "db_akademik";
    private $username = "postgres";
    private $password = "admin";
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO("pgsql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    public function tampil() {
        try {
            $query = "SELECT * FROM mahasiswa";
            return $this->conn->query($query);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function simpan($nama, $alamat, $umur) {
        try {
            $query = "INSERT INTO mahasiswa (nama, alamat, umur) VALUES (:nama, :alamat, :umur)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':umur', $umur);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hapus($id) {
        try {
            $query = "DELETE FROM mahasiswa WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>
