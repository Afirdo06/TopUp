<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items for <?= htmlspecialchars($game['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar */
        .sidebar {
            background-color: #2c3e50;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            color: #ecf0f1;
        }

        .sidebar a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 16px;
            display: block;
            padding: 12px 0;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
            border-radius: 5px;
        }

        /* Profile box */
        .profile-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-card {
            background-color: #34495e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: center;
        }

        .profile-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 2px solid #fff;
            margin-bottom: 10px;
        }

        .profile-card h6 {
            color: #ecf0f1;
            font-size: 16px;
            margin: 0;
        }

        /* Main content */
        .main-content {
            margin-left: 270px;
            padding: 30px;
            background-color: #ecf0f1;
            min-height: 100vh;
        }

        /* Card Style */
        .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Typography */
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 500;
            color: #343a40;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
        }

        .btn-primary:hover {
            background-color: #5e4dbf;
            border-color: #4f3b9a;
        }

        .btn-warning {
            background-color: #ff8c42;
            border-color: #ff8c42;
        }

        .btn-warning:hover {
            background-color: #e07b2a;
            border-color: #d46919;
        }

        .btn-danger {
            background-color: #ff4d4f;
            border-color: #ff4d4f;
        }

        .btn-danger:hover {
            background-color: #e62e34;
            border-color: #cc1e27;
        }

        /* Footer Styling */
        .footer {
            background-color: #34495e;
            color: #ecf0f1;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            position: static;
            width: 100%;
        }

        .footer a {
            color: #ecf0f1;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="profile-box">
            <div class="profile-card">
                <img src="https://via.placeholder.com/70" alt="Profile Picture">
                <h6>Welcome, <?= session()->get('username'); ?>!</h6>
            </div>
        </div>
        <h4>Admin Menu</h4>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/manage_games">Manajemen Game</a>
        <a href="/admin/manage_packages">Manajemen Produk</a>
        <a href="/admin/transactions">Manajemen Transaksi</a>
        <a href="/admin/logout" class="btn btn-danger mt-3">Logout</a>
    </div>

    <div class="main-content">
        <h1>Pengaturan Item dan harga Game <?= htmlspecialchars($game['name']) ?></h1>

        <!-- Pesan Flashdata -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mt-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Tombol Tambah Paket -->
        <a href="/admin/packages/add/<?= $game['id'] ?>" class="btn btn-primary mb-3">Tambah Paket</a>
        <a href="/admin/manage_packages" class="btn btn-secondary mb-3">Kembali ke Pilih Game</a>

        <div class="row">
            <?php if (!empty($packages)): ?>
                <?php foreach ($packages as $package): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($package['package_name']) ?></h5>
                                <p class="card-text">Harga: <?= htmlspecialchars($package['price']) ?> <?= htmlspecialchars($package['currency_type']) ?></p>
                                <a href="/admin/packages/edit/<?= $package['id'] ?>" class="btn btn-warning">Edit</a>

                                <!-- Form Delete Paket -->
                                <form action="<?= site_url('/admin/packages/delete/'.$package['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Card warning jika tidak ada paket -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tidak ada paket untuk game ini.</h5>
                            <p class="card-text">Silakan tambahkan paket untuk game <?= htmlspecialchars($game['name']) ?>.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>10122491 | Afirdo Ridwan Pakpahan | IF-5</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
