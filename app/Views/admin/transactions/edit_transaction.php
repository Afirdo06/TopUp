<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1>Edit Transaksi</h1>
    <form action="<?= site_url('admin/transactions/update/' . $transaction['id']) ?>" method="POST">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="username_game" class="form-label">Username Game</label>
            <input type="text" name="username_game" id="username_game" class="form-control" value="<?= $transaction['username_game'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="game_user_id" class="form-label">Game User ID</label>
            <input type="text" name="game_user_id" id="game_user_id" class="form-control" value="<?= $transaction['game_user_id'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $transaction['email'] ?>" required>
        </div>
        <div class="mb-3">
    <label for="game_id" class="form-label">Game</label>
    <select name="game_id" id="game_id" class="form-control" required>
        <?php foreach ($games as $game): ?>
            <option value="<?= $game['id'] ?>" <?= $game['id'] == $transaction['game_id'] ? 'selected' : '' ?>>
                <?= $game['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <div class="mb-3">
            <label for="package_id" class="form-label">Package</label>
            <select name="package_id" id="package_id" class="form-control" required>
                <?php foreach ($packages as $package): ?>
                    <option value="<?= $package['id'] ?>" <?= $package['id'] == $transaction['package_id'] ? 'selected' : '' ?>>
                        <?= $package['package_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="qris" <?= $transaction['payment_method'] == 'qris' ? 'selected' : '' ?>>QRIS</option>
                <option value="dana" <?= $transaction['payment_method'] == 'dana' ? 'selected' : '' ?>>Dana</option>
                <option value="credit_card" <?= $transaction['payment_method'] == 'credit_card' ? 'selected' : '' ?>>Kartu Kredit</option>
                <option value="bank_transfer" <?= $transaction['payment_method'] == 'bank_transfer' ? 'selected' : '' ?>>Transfer Bank</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/transactions') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>


</html>
