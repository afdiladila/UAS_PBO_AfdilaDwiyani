<?php

abstract class Mahasiswa {
    // Atribut global (induk) yang terenkapsulasi
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal; // Memetakan kolom tarif_ukt_nominal

    // Constructor untuk memetakan nilai dari kolom database saat objek dibuat
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // ==================== GETTER & SETTER ====================
    // Dibutuhkan untuk mengakses properti protected dari luar kelas jika diperlukan
    
    public function getIdMahasiswa() { return $this->id_mahasiswa; }
    public function getNamaMahasiswa() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }

    // ==================== ABSTRACT METHODS ====================
    // Metode abstrak tanpa isi, wajib diimplementasikan oleh kelas anak nantinya
    
    /**
     * Menghitung total tagihan semester berjalan berdasarkan jenis pembiayaan
     */
    abstract public function hitungTagihanSemester();

    /**
     * Menampilkan data spesifik/akademik dari masing-masing jenis pembiayaan
     */
    abstract public function tampilkanSpesifikasiAkademik();
}