<?php

class Database {
    private $host     = "localhost";
    private $username = "root";
    private $password = ""; // Sesuaikan jika XAMPP kamu menggunakan password
    private $database = "DB_UAS_PBO_TRPL1A_AfdilaDwiyani";
    public $conn;

    // Constructor otomatis berjalan saat class dipanggil
    public function __construct() {
        // Melakukan koneksi dengan Driver MySQLi OOP
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Validasi jika koneksi error
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }

        // Set encoding agar aman
        $this->conn->set_charset("utf8");
    }

    // Method untuk mendapatkan instance koneksi
    public function getConnection() {
        return $this->conn;
    }

    // Method untuk menutup koneksi jika diperlukan
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}