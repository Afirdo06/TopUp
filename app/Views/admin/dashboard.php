<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background-color: #f4f6f9 !important;
            min-height: 100vh;
        }

        .card-header {
            background-color: #34495e;
            color: #ecf0f1;
            font-size: 20px;
            padding: 15px;
        }

        /* Game List Styling */
        .game-box {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            height: 320px;
        }

        .game-box:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .game-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .game-box h5 {
            margin-top: 10px;
            font-size: 20px;
            color: #2c3e50;
        }

        /* Package List Styling */
        .package-box {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            height: 180px;
        }

        .package-box:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .package-box h6 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .package-box p {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .package-box .price {
            font-size: 16px;
            color: #e74c3c;
            font-weight: bold;
        }

        .btn-logout {
            background-color: #d9534f;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            border: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }

        /* Footer Styling */
        .footer {
            background-color: #34495e;
            color: #ecf0f1;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            position: static; /* Mengubah posisi footer menjadi 'static' */
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
        <a href="/admin/logout" class="btn-logout">Logout</a>
    </div>

    <div class="main-content">
        <!-- Page Title -->
        <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title"><i class="fas fa-gamepad"></i> Total Games</h5>
                                <h2 class="mb-0"><?= count($games) ?></h2>
                            </div>
                            <i class="fas fa-gamepad fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title"><i class="fas fa-box"></i> Total Packages</h5>
                                <h2 class="mb-0"><?= count($packages) ?></h2>
                            </div>
                            <i class="fas fa-box fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Total Transactions</h5>
                                <h2 class="mb-0"><?= count($transactions) ?></h2>
                            </div>
                            <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="fas fa-chart-bar"></i> Transactions per Game</h3>
            </div>
            <div class="card-body">
                <canvas id="transactionsChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Game List -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Game List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($games)): ?>
                        <?php foreach ($games as $game): ?>
                            <div class="col-md-3 mb-4">
                                <div class="game-box" <?php if (session()->get('role') !== 'admin'): ?>onclick="window.location='/user/topup_game/<?= $game['id']; ?>'"<?php endif; ?>>
                                    <img src="/uploads/<?= $game['image']; ?>" alt="<?= $game['name']; ?>">
                                    <h5><?= $game['name']; ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No games available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Package List -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Package List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($packages)): ?>
                        <?php foreach ($packages as $package): ?>
                            <div class="col-md-2 mb-4">
                                <div class="package-box">
                                    <h6><?= $package['game_name']; ?></h6>
                                    <p><strong>Package:</strong> <?= $package['package_name']; ?></p>
                                    <p class="price"><?= number_format($package['price'], 2); ?> IDR</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No packages available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>  10122491 | Afirdo Ridwan Pakpahan |  IF-5</p>
    </div>

    <!-- Link to Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prepare data for chart
        <?php
        $gameNames = [];
        $transactionCounts = [];
        foreach ($games as $game) {
            $gameNames[] = $game['name'];
            $count = 0;
            foreach ($transactions as $transaction) {
                if ($transaction['game_id'] == $game['id']) {
                    $count++;
                }
            }
            $transactionCounts[] = $count;
        }
        ?>

        const ctx = document.getElementById('transactionsChart').getContext('2d');
        const transactionsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($gameNames) ?>,
                datasets: [{
                    label: 'Number of Transactions',
                    data: <?= json_encode($transactionCounts) ?>,
                    backgroundColor: 'rgba(255, 193, 7, 0.5)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        // Add some interactivity
        document.querySelectorAll('.game-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) rotate(1deg)';
            });
            box.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });

        document.querySelectorAll('.package-box').forEach(box => {
            box.addEventListener('click', function() {
                alert('Package: ' + this.querySelector('p strong').nextSibling.textContent.trim());
            });
        });
    </script>
</body>

</html>
