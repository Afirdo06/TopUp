<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Navbar or Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/admin/dashboard">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/manage_games">Manage Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/games/add">Tambah Game Baru</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Flash Error Message -->
        <?php if ($errors = session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mt-3">
                <?php if (is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <?= esc($errors) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1 class="mt-4">Tambah Game Baru</h1>

        <!-- Card for the Add Game Form -->
        <div class="card mt-4">
            <div class="card-body">
            <form method="POST" action="/admin/games/save" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Game Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Game Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Game</button>
</form>

            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
