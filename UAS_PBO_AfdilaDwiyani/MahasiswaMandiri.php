<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik Mandiri
    private $golonganUkt;
    private $namaWali;

    // Constructor menerima parameter induk + parameter anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // Implementasi Method Abstrak 1
    public function hitungTagihanSemester() {
        // Mahasiswa mandiri membayar penuh sesuai tarif UKT nominal
        return $this->tarifUktNominal;
    }

    // Implementasi Method Abstrak 2
    public function tampilkanSpesifikasiAkademik() {
        return "Golongan UKT: " . $this->golonganUkt . " | Nama Wali: " . $this->namaWali;
    }

    // Method khusus untuk mengambil semua data Mahasiswa Mandiri dari database
    public static function getQuerySemuaMandiri($dbConnection) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt_nominal, golongan_ukt, nama_wali 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'mandiri'";
        
        return $dbConnection->query($sql);
    }
}