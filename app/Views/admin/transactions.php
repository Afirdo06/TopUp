<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi</title>
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

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            color: #343a40;
            font-weight: 600;
        }

        .table td {
            background-color: #ffffff;
            color: #6c757d;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .footer {
            background-color: #34495e;
            color: #ecf0f1;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            position: static;
            width: 100%;
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
        <h1>Manajemen Transaksi</h1>
        <a href="/admin/transactions/create" class="btn btn-primary mb-3">Tambah Transaksi</a>


        <div class="card">
            <div class="card-body">
                <table class="table table-striped mt-3">
                <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Username Game</th>
        <th>Game User ID</th>
        <th>Email</th>
        <th>Game</th>
        <th>Package</th>
        <th>Metode Pembayaran</th> <!-- Add this column for payment_method -->
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php foreach ($transactions as $transaction): ?>

        <tr>
            <td><?= $transaction['id'] ?></td>
            <td><?= $transaction['username'] ?></td>
            <td><?= $transaction['username_game'] ?></td>
            <td><?= $transaction['game_user_id'] ?></td>
            <td><?= $transaction['email'] ?></td>
            <td><?= $transaction['game_name'] ?></td>
            <td><?= $transaction['package_name'] ?></td>
            
            <td><?= ucfirst($transaction['payment_method']) ?></td> <!-- Display the payment_method here -->
            <td><?= $transaction['created_at'] ?></td>
            <td>
                <a href="<?= site_url('admin/transactions/edit/'.$transaction['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= site_url('admin/transactions/delete/'.$transaction['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>


                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <p> 10122491 | Afirdo Ridwan Pakpahan |  IF-5</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
