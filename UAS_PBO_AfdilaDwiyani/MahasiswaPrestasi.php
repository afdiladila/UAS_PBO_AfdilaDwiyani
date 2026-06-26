<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik Prestasi
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Implementasi Method Abstrak 1
    public function hitungTagihanSemester() {
        // Mahasiswa prestasi membayar UKT yang sudah dipotong/disesuaikan pemberi beasiswa
        return $this->tarifUktNominal;
    }

    // Implementasi Method Abstrak 2
    public function tampilkanSpesifikasiAkademik() {
        return "Instansi Beasiswa: " . $this->namaInstansiBeasiswa . " | Syarat Minimal IPK: " . $this->minimalIpkSyarat;
    }

    // Method khusus untuk mengambil semua data Mahasiswa Prestasi dari database
    public static function getQuerySemuaPrestasi($dbConnection) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt_nominal, nama_instansi_beasiswa, minimal_ipk_syarat 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'prestasi'";
        
        return $dbConnection->query($sql);
    }
}