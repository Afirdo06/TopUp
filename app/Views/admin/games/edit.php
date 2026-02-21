<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
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
        <h1>Edit Game</h1>

        <!-- Form Edit Game -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Edit Detail Game</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/games/update/<?= $game['id']; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Game</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $game['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Game</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img src="/uploads/<?= $game['image']; ?>" width="100" class="mt-2" alt="<?= $game['name']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Game</button>
                    <a href="/admin/manage_games" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>10122491 | Afirdo Ridwan Pakpahan | IF-5</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
