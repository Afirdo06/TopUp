<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 0.5rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .card {
            border-radius: 0.75rem;
            border: 1px solid #ddd;
            margin-bottom: 1.5rem;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .alert {
            font-size: 1rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center header-title">Tambah Transaksi Game</h1>

    <!-- Pesan Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('/admin/transactions/store') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Pilihan Game -->
                <div class="mb-3">
                    <label for="game_id" class="form-label">Pilih Game</label>
                    <select name="game_id" id="game_id" class="form-control" required>
                        <option value="">Pilih Game</option>
                        <?php foreach ($games as $game): ?>
                            <option value="<?= $game['id'] ?>"><?= $game['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilihan Paket -->
                <div class="mb-3">
                    <label for="package_id" class="form-label">Pilih Paket</label>
                    <select name="package_id" id="package_id" class="form-control" required>
                        <option value="">Pilih Paket</option>
                        <?php foreach ($packages as $package): ?>
                            <option value="<?= $package['id'] ?>"><?= $package['package_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Username Game -->
                <div class="mb-3">
                    <label for="username_game" class="form-label">Username Game</label>
                    <input type="text" name="username_game" id="username_game" class="form-control" required>
                </div>

                <!-- Game User ID -->
                <div class="mb-3">
                    <label for="game_user_id" class="form-label">Game User ID</label>
                    <input type="text" name="game_user_id" id="game_user_id" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="qris">QRIS</option>
                        <option value="dana">DANA</option>
                        <option value="gopay">GoPay</option>
                        <option value="alfamart">Alfamart</option>
                        <option value="indomart">Indomart</option>
                        <option value="bni">BNI</option>
                        <option value="bri">BRI</option>
                        <option value="bca">BCA</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
