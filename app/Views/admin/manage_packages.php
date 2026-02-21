<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .card-img-top {
            width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 1.25rem;
            text-align: left; /* Mengubah menjadi rata kiri */
        }

        .card-body h5 {
            font-size: 1.2rem;
            font-weight: 500;
            color: #343a40;
        }

        .card-body p {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Typography */
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
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
        /* Footer */
        .footer {
            background-color: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
            position: static;
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
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
        <!-- Page Title -->
        <h1>Manage Packages</h1>

        <!-- Flash Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mt-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari game berdasarkan nama...">
        </div>

        <!-- Table for Games -->
        <div class="card">
            <div class="card-header">
                <h5>Pilih Game untuk Mengelola Paket</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="gamesTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama Game</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                            <tr>
                                <td><?= $game['id'] ?></td>
                                <td><img src="/uploads/<?= $game['image'] ?>" alt="<?= $game['name'] ?>" style="width: 60px; height: 60px; object-fit: cover;"></td>
                                <td class="game-name"><?= htmlspecialchars($game['name']) ?></td>
                                <td>
                                    <a href="/admin/packages/manage_items/<?= $game['id'] ?>" class="btn btn-primary btn-sm">Kelola Paket</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>10122491 | Afirdo Ridwan Pakpahan | IF-5</p>
    </div>

    <!-- Link to Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#gamesTable tbody tr');
            rows.forEach(row => {
                const gameName = row.querySelector('.game-name').textContent.toLowerCase();
                if (gameName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
