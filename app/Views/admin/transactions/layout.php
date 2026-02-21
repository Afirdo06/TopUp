<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?></title>
    <!-- CSS umum untuk tampilan dashboard -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>

    <!-- Header: Menampilkan menu dan informasi user -->
    <header>
        <nav>
            <ul>
                <li><a href="<?= site_url('/admin/dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= site_url('/admin/transactions') ?>">Transaksi</a></li>
                <!-- Tambahkan menu lainnya -->
                <li><a href="<?= site_url('/logout') ?>">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content: Bagian konten yang berubah-ubah di setiap halaman -->
    <main>
        <div class="container">
            <?= $this->renderSection('content') ?> <!-- Konten spesifik halaman -->
        </div>
    </main>

    <!-- Footer: Informasi copyright atau link tambahan -->
    <footer>
        <p>&copy; 2024 Nama Perusahaan</p>
    </footer>

    <!-- Script JS umum -->
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
</body>
</html>
