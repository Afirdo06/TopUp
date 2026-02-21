<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up Game</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Roboto', sans-serif;
            color: #333;
            padding-bottom: 60px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 40px;
        }

        .menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
            z-index: 1000;
        }

        .menu-btn div {
            width: 35px;
            height: 5px;
            background-color: #fff;
            margin: 6px 0;
            transition: 0.4s;
        }

        .nav-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #2c3e50;
            display: none;
            flex-direction: column;
            padding: 20px;
            color: white;
            z-index: 999;
            transition: transform 0.3s ease;
        }

        .nav-menu.show {
            display: flex;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            padding: 15px;
            margin: 10px 0;
            transition: background-color 0.3s;
        }

        .nav-menu a:hover {
            background-color: #8e44ad;
        }

        
        .btn-logout {
            background-color: #8e44ad; 
            color: white;
            text-align: center;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 30px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;
            margin-top: 20px; 
        }

        .btn-logout:hover {
            background-color: #6a1b9a; 
            transform: translateY(-3px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            overflow: hidden;
            padding: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            width: 100%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .game-card {
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
        }

        .game-card:hover {
            background-color: #f8f9fa;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(145deg, #6a1b9a, #8e44ad);
            border: none;
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #8e44ad, #6a1b9a);
            transform: translateY(-3px);
        }

        .container {
            max-width: 1400px;
            padding: 0 30px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .col-md-3 {
            flex: 0 0 280px;
            max-width: 280px;
        }

        @media (max-width: 768px) {
            .col-md-3 {
                flex: 0 0 45%;
                max-width: 45%;
            }

            .container {
                padding: 0 20px;
            }

            .row {
                gap: 20px;
            }
        }

        @media (max-width: 480px) {
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .row {
                gap: 15px;
            }
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 0.85rem;
            margin-top: auto;
        }

        footer a {
            color: #8e44ad;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="menu-btn" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="nav-menu" id="navMenu">
        <div class="mt-auto">
            <a href="<?= base_url('user/logout'); ?>" class="btn-logout">Logout</a>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Top-Up Game</h1>
        <div class="row">
            <?php foreach ($games as $game): ?>
                <div class="col-md-3 mb-4">
                    <div class="card game-card">
                    <a href="<?= base_url('user/topup_game/' . $game['id']); ?>">
                    <img src="<?= base_url('uploads/' . $game['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($game['name']); ?>">
                    </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($game['name']); ?></h5>                          
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-light">
    <p>10122491 | Afirdo Ridwan Pakpahan | IF-5</p>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('show');
        }
    </script>
</body>
</html>
