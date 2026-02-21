<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up <?= htmlspecialchars($game['name']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Roboto', sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-btn {
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        .nav-menu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #34495e;
            transition: left 0.3s ease;
            padding: 20px;
            z-index: 1000;
        }

        .nav-menu.show {
            left: 0;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            border-bottom: 1px solid #7f8c8d;
        }

        .nav-menu a:hover {
            color: #3498db;
        }

        .container {
            flex: 1;
            padding: 40px 20px;
        }

        .topup-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1200px;
            margin: 0 auto;
        }

        .game-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .game-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .game-content {
            display: flex;
            flex-wrap: wrap;
        }

        .game-info {
            flex: 1;
            padding: 40px;
            min-width: 300px;
        }

        .game-image {
            width: 100%;
            max-width: 400px;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .game-description {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #667eea;
        }

        .game-description h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .game-description p {
            color: #555;
            line-height: 1.6;
        }

        .topup-form {
            flex: 1;
            padding: 40px;
            background: #f8f9fa;
            min-width: 300px;
        }

        .form-title {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .package-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            flex: 1 1 calc(33.333% - 10px);
            min-width: 150px;
        }

        .package-card:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .package-card.selected {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .package-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .package-price {
            color: #667eea;
            font-weight: 700;
        }

        .payment-method-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            text-align: center;
            flex: 1 1 calc(33.333% - 10px);
            min-width: 120px;
        }

        .payment-method-card:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .payment-method-card.selected {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .payment-method-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .payment-method-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 25px;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .game-content {
                flex-direction: column;
            }

            .game-info, .topup-form {
                padding: 20px;
            }

            .game-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="menu-btn" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
        <div>Top-Up System</div>
        <div></div>
    </div>

    <div class="nav-menu" id="navMenu">
        <a href="<?= base_url('user/topup'); ?>"><i class="fas fa-gamepad"></i> Pilih Game</a>
        <a href="<?= base_url('user/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="topup-container">
            <div class="game-header">
                <h1><i class="fas fa-coins"></i> Top-Up <?= htmlspecialchars($game['name']); ?></h1>
            </div>

            <div class="game-content">
                <div class="game-info">
                    <img src="<?= base_url('uploads/' . $game['image']); ?>" alt="<?= htmlspecialchars($game['name']); ?>" class="game-image">
                    <div class="game-description">
                        <h3><i class="fas fa-info-circle"></i> Tentang Game</h3>
                        <p><?= htmlspecialchars($game['description'] ?? 'Top-up game ini memungkinkan Anda mendapatkan item dan mata uang dalam game dengan cepat dan aman. Pilih paket yang sesuai dengan kebutuhan Anda dan nikmati pengalaman bermain yang lebih seru!'); ?></p>
                        <p><strong>Cara Top-Up:</strong> Masukkan ID game Anda, pilih paket yang diinginkan, pilih metode pembayaran, dan selesaikan transaksi. Item akan dikirim otomatis ke akun game Anda.</p>
                    </div>
                </div>

                <div class="topup-form">
                    <h2 class="form-title"><i class="fas fa-shopping-cart"></i> Form Top-Up</h2>
                    <form id="topupForm" action="<?= base_url('user/topup_process'); ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="game_id" value="<?= $game_id ?>">

                        <div class="form-group">
                            <label for="username_game" class="form-label"><i class="fas fa-user"></i> Username Game</label>
                            <input type="text" class="form-control" id="username_game" name="username_game" required>
                        </div>

                        <div class="form-group">
                            <label for="game_user_id" class="form-label"><i class="fas fa-id-card"></i> ID Game</label>
                            <input type="text" class="form-control" id="game_user_id" name="game_user_id" value="<?= htmlspecialchars($game_user_id) ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-box"></i> Pilih Paket</label>
                            <div id="packages" style="display: flex; flex-wrap: wrap;">
                                <?php foreach ($packages as $package): ?>
                                    <div class="package-card" onclick="selectPackage(<?= $package['id'] ?>, this)">
                                        <div class="package-name"><?= htmlspecialchars($package['package_name']) ?></div>
                                        <div class="package-price">Rp <?= number_format($package['price'], 0, ',', '.') ?></div>
                                        <input type="radio" name="package_id" value="<?= $package['id'] ?>" style="display: none;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-credit-card"></i> Metode Pembayaran</label>
                            <div id="payment-methods" style="display: flex; flex-wrap: wrap;">
                                <div class="payment-method-card" onclick="selectPayment('qris', this)">
                                    <img src="<?= base_url('uploads/metodebayar/qris.png'); ?>" alt="QRIS" class="payment-method-image">
                                    <div class="payment-method-name">QRIS</div>
                                    <input type="radio" name="payment_method" value="qris" style="display: none;">
                                </div>
                                <div class="payment-method-card" onclick="selectPayment('dana', this)">
                                    <img src="<?= base_url('uploads/metodebayar/dana.png'); ?>" alt="Dana" class="payment-method-image">
                                    <div class="payment-method-name">Dana</div>
                                    <input type="radio" name="payment_method" value="dana" style="display: none;">
                                </div>
                                <div class="payment-method-card" onclick="selectPayment('ovo', this)">
                                    <img src="<?= base_url('uploads/metodebayar/ovo.png'); ?>" alt="OVO" class="payment-method-image">
                                    <div class="payment-method-name">OVO</div>
                                    <input type="radio" name="payment_method" value="ovo" style="display: none;">
                                </div>
                                <div class="payment-method-card" onclick="selectPayment('alfamart', this)">
                                    <img src="<?= base_url('uploads/metodebayar/alfamart.png'); ?>" alt="Alfamart" class="payment-method-image">
                                    <div class="payment-method-name">Alfamart</div>
                                    <input type="radio" name="payment_method" value="alfamart" style="display: none;">
                                </div>
                                <div class="payment-method-card" onclick="selectPayment('indomaret', this)">
                                    <img src="<?= base_url('uploads/metodebayar/indomaret.png'); ?>" alt="Indomaret" class="payment-method-image">
                                    <div class="payment-method-name">Indomaret</div>
                                    <input type="radio" name="payment_method" value="indomaret" style="display: none;">
                                </div>
                                <div class="payment-method-card" onclick="selectPayment('transfer_bank', this)">
                                    <img src="<?= base_url('uploads/metodebayar/transferbaank.jpeg'); ?>" alt="Transfer Bank" class="payment-method-image">
                                    <div class="payment-method-name">Transfer Bank</div>
                                    <input type="radio" name="payment_method" value="transfer_bank" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <button type="submit" class="btn btn-submit"><i class="fas fa-paper-plane"></i> Lakukan Top-Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Top-Up System | 10122491 | Afirdo Ridwan Pakpahan | IF-5</p>
    </footer>

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Memproses top-up Anda...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    <h5 class="mt-3">Transaksi Berhasil!</h5>
                    <p>Top-up Anda telah berhasil diproses.</p>
                    <button type="button" class="btn btn-primary" onclick="window.location.reload()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('show');
        }

        function selectPackage(packageId, element) {
            // Remove selected class from all packages
            document.querySelectorAll('.package-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to clicked package
            element.classList.add('selected');

            // Check the radio button
            element.querySelector('input[type="radio"]').checked = true;
        }

        function selectPayment(paymentMethod, element) {
            // Remove selected class from all payment methods
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to clicked payment method
            element.classList.add('selected');

            // Check the radio button
            element.querySelector('input[type="radio"]').checked = true;
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const navMenu = document.getElementById('navMenu');
            const menuBtn = document.querySelector('.menu-btn');

            if (!navMenu.contains(event.target) && !menuBtn.contains(event.target)) {
                navMenu.classList.remove('show');
            }
        });

        // Handle form submission with AJAX
        document.getElementById('topupForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Show loading modal
            const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                loadingModal.hide();
                if (data.success) {
                    // Show success modal
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                loadingModal.hide();
                alert('An error occurred. Please try again.');
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
