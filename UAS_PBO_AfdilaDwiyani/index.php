<?php
// Impor file koneksi OOP dan subclass
require_once 'koneksi.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// Instansiasi Objek Database
$db = new Database();
$conn = $db->getConnection();

// Ambil data dari database melalui static method milik masing-masing subclass
$dataMandiri   = MahasiswaMandiri::getQuerySemuaMandiri($conn);
$dataBidikmisi = MahasiswaBidikmisi::getQuerySemuaBidikmisi($conn);
$dataPrestasi  = MahasiswaPrestasi::getQuerySemuaPrestasi($conn);

// Hitung statistik untuk info cards
$countMandiri   = $dataMandiri->num_rows;
$countBidikmisi = $dataBidikmisi->num_rows;
$countPrestasi  = $dataPrestasi->num_rows;
$totalSemua     = $countMandiri + $countBidikmisi + $countPrestasi;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SINFO-UKT - Registrasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7fc; font-family: 'Segoe UI', system-ui, sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLE (Sisi Kiri) */
        .sidebar { background-color: #1a233a; min-height: 100vh; color: #a2a8b5; position: fixed; width: 260px; z-index: 100; transition: all 0.3s; }
        .sidebar .brand-section { padding: 24px; border-bottom: 1px solid #232e48; display: flex; align-items: center; }
        .sidebar .avatar-circle { width: 45px; height: 45px; background-color: #0dcaf0; color: #1a233a; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; }
        .sidebar .menu-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #53627c; padding: 20px 24px 10px; font-weight: bold; }
        
        /* Nav-Pills Custom di Sidebar */
        .sidebar .nav-link { color: #8e9aa8; padding: 12px 24px; display: flex; align-items: center; gap: 12px; border-left: 4px solid transparent; border-radius: 0; transition: all 0.2s; font-size: 0.95rem; background: none; width: 100%; border-top: none; border-right: none; border-bottom: none; }
        .sidebar .nav-link:hover { color: #ffffff; background-color: #232d47; }
        .sidebar .nav-link.active { color: #ffffff; background-color: #232d47; border-left-color: #4f46e5; font-weight: 500; }
        
        /* MAIN CONTENT AREA (Sisi Kanan) */
        .main-content { margin-left: 260px; padding: 30px; min-height: 100vh; }
        
        /* TOPBAR HERO BANNER */
        .hero-banner { background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%); color: white; border-radius: 16px; padding: 28px; position: relative; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.15); }
        
        /* STATS CARDS */
        .stat-card { background: white; border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); position: relative; overflow: hidden; }
        .stat-card::after { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }
        .card-total::after { background-color: #4f46e5; }
        .card-mandiri::after { background-color: #f59e0b; }
        .card-bidikmisi::after { background-color: #10b981; }
        .card-prestasi::after { background-color: #06b6d4; }
        .stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        
        /* TABLE CONTAINER */
        .card-table-container { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); border: none; padding: 25px; }
        .table th { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; background-color: #f8fafc; border-bottom: 2px solid #e2e8f0; padding: 14px; }
        .table td { padding: 14px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; }
        
        /* Top User Profile Inisial */
        .user-avatar { width: 40px; height: 40px; background-color: #4f46e5; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-section gap-3">
            <div class="avatar-circle">S</div>
            <div>
                <h6 class="mb-0 fw-bold text-white">SINFO-UKT</h6>
                <small class="text-muted" style="font-size: 0.75rem;">Politeknik Negeri Cilacap</small>
            </div>
        </div>
        
        <div class="menu-label">Menu Utama</div>
        
        <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active text-start" id="pill-mandiri-tab" data-bs-toggle="pill" data-bs-target="#pill-mandiri" type="button" role="tab">
                <i class="bi bi-person-fill"></i> Mahasiswa Mandiri
            </button>
            
            <button class="nav-link text-start" id="pill-bidikmisi-tab" data-bs-toggle="pill" data-bs-target="#pill-bidikmisi" type="button" role="tab">
                <i class="bi bi-gift-fill"></i> Mahasiswa Bidikmisi
            </button>
            
            <button class="nav-link text-start" id="pill-prestasi-tab" data-bs-toggle="pill" data-bs-target="#pill-prestasi" type="button" role="tab">
                <i class="bi bi-star-fill"></i> Mahasiswa Prestasi
            </button>
            </div>
    </div>

    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Dashboard Mahasiswa</h4>
                <p class="text-muted small mb-0">Selamat datang kembali, Admin 👋</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-0 shadow-sm"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-0 shadow-sm ps-0" placeholder="Cari data...">
                </div>
                <div class="user-avatar">AD</div>
            </div>
        </div>

        <div class="hero-banner mb-4">
            <h2 class="fw-bold mb-1">Halo, Administrator! ✨</h2>
            <p class="mb-2 opacity-75">Sistem Informasi Pembayaran | Tersemat <?= $totalSemua; ?> ID Mahasiswa Aktif</p>
            <p class="mb-0 small opacity-100"><i class="bi bi-info-circle-fill"></i> Pantau, kelola, dan verifikasi status pembiayaan UKT akademik Anda di sini secara terstruktur.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-3">
                <div class="card stat-card card-total p-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-semibold">Total Mahasiswa</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1"><?= $totalSemua; ?></h3>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card stat-card card-mandiri p-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-semibold">Jalur Mandiri</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1"><?= $countMandiri; ?></h3>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card stat-card card-bidikmisi p-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-semibold">Bidikmisi / KIP-K</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1"><?= $countBidikmisi; ?></h3>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-mortarboard-fill"></i></div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card stat-card card-prestasi p-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-semibold">Jalur Prestasi</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1"><?= $countPrestasi; ?></h3>
                    </div>
                    <div class="stat-icon bg-info-subtle text-info"><i class="bi bi-trophy-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="card card-table-container">
            
            <div class="tab-content p-0 shadow-none border-0" id="v-pills-tabContent">
                
                <div class="tab-pane fade show active" id="pill-mandiri" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-table text-warning"></i> Data Registrasi Mahasiswa Mandiri</h5>
                        <span class="badge bg-warning-subtle text-warning border px-3 py-2 rounded-pill">Skema UKT + Tambahan</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID Mhs</th><th>NIM</th><th>Nama Mahasiswa</th><th>Smstr</th><th>UKT Pokok</th><th>Spesifikasi Akademik (Atribut Anak)</th><th class="text-end">Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($countMandiri > 0): ?>
                                    <?php while($row = $dataMandiri->fetch_assoc()): 
                                        $mhs = new MahasiswaMandiri($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['golongan_ukt'], $row['nama_wali']);
                                    ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#<?= $mhs->getIdMahasiswa(); ?></td>
                                        <td class="fw-semibold text-primary"><?= $mhs->getNim(); ?></td>
                                        <td class="fw-medium"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td><span class="badge bg-light text-dark border">S<?= $mhs->getSemester(); ?></span></td>
                                        <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                        <td><span class="badge bg-warning-subtle text-warning-emphasis"><i class="bi bi-shield-check"></i> <?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                        <td class="text-end fw-bold text-danger">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data mahasiswa mandiri.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pill-bidikmisi" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-table text-success"></i> Data Registrasi Mahasiswa Bidikmisi</h5>
                        <span class="badge bg-success-subtle text-success border px-3 py-2 rounded-pill">Subsidi Pemerintah</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID Mhs</th><th>NIM</th><th>Nama Mahasiswa</th><th>Smstr</th><th>Spesifikasi Akademik (Atribut Anak)</th><th class="text-end">Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($countBidikmisi > 0): ?>
                                    <?php while($row = $dataBidikmisi->fetch_assoc()): 
                                        $mhs = new MahasiswaBidikmisi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 0, $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']);
                                    ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#<?= $mhs->getIdMahasiswa(); ?></td>
                                        <td class="fw-semibold text-success"><?= $mhs->getNim(); ?></td>
                                        <td class="fw-medium"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td><span class="badge bg-light text-dark border">S<?= $mhs->getSemester(); ?></span></td>
                                        <td><span class="badge bg-success-subtle text-success-emphasis"><i class="bi bi-wallet2"></i> <?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                        <td class="text-end fw-bold text-success">Rp 0 <span class="badge bg-success text-white ms-1" style="font-size: 0.75rem;">Gratis</span></td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data mahasiswa bidikmisi.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pill-prestasi" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-table text-info"></i> Data Registrasi Mahasiswa Prestasi</h5>
                        <span class="badge bg-info-subtle text-info border px-3 py-2 rounded-pill">Beasiswa Potongan 75%</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID Mhs</th><th>NIM</th><th>Nama Mahasiswa</th><th>Smstr</th><th>UKT Asli</th><th>Spesifikasi Akademik (Atribut Anak)</th><th class="text-end">Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($countPrestasi > 0): ?>
                                    <?php while($row = $dataPrestasi->fetch_assoc()): 
                                        $mhs = new MahasiswaPrestasi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['nama_instansi_beasiswa'], $row['minimal_ipk_syarat']);
                                    ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#<?= $mhs->getIdMahasiswa(); ?></td>
                                        <td class="fw-semibold text-info"><?= $mhs->getNim(); ?></td>
                                        <td class="fw-medium"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td><span class="badge bg-light text-dark border">S<?= $mhs->getSemester(); ?></span></td>
                                        <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                        <td><span class="badge bg-info-subtle text-info-emphasis"><i class="bi bi-trophy"></i> <?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                        <td class="text-end fw-bold text-primary">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data mahasiswa prestasi.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi secara OOP
$db->closeConnection();
?>