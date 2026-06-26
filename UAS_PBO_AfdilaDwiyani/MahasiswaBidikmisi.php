<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // METHOD OVERRIDING
    public function hitungTagihanSemester() {
        // Total tagihan = 0 (Gratis Penuh)
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "No KIP Kuliah: " . $this->nomorKipKuliah . " | Dana Saku/Bulan: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    public static function getQuerySemuaBidikmisi($dbConnection) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, nomor_kip_kuliah, dana_saku_subsidi 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'bidikmisi'";
        
        return $dbConnection->query($sql);
    }
}