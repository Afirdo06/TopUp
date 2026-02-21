<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/admin/dashboard">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/manage_packages">Manage Package</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="mt-4">Tambah Paket untuk Game <?= htmlspecialchars($game['name']) ?></h1>

        <!-- Menampilkan pesan error jika ada -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Form untuk tambah paket -->
        <form action="/admin/packages/save" method="POST">
            <?= csrf_field() ?>

            <!-- Nama Paket -->
            <div class="mb-3">
                <label for="package_name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="package_name" name="package_name" value="<?= old('package_name') ?>" required>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= old('price') ?>" required>
            </div>

            <!-- Jenis Mata Uang -->
            <div class="mb-3">
                <label for="currency_type" class="form-label">Jenis Mata Uang</label>
                <select class="form-control" id="currency_type" name="currency_type" required>
                    <option value="IDR" <?= old('currency_type') == 'IDR' ? 'selected' : '' ?>>IDR</option>
                    <option value="USD" <?= old('currency_type') == 'USD' ? 'selected' : '' ?>>USD</option>
                </select>
            </div>

            <!-- Hidden Input untuk Game ID -->
            <input type="hidden" name="game_id" value="<?= $game['id'] ?>">

            <!-- Submit -->
            <button type="submit" class="btn btn-success">Simpan Paket</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
