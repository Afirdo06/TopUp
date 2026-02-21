<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #3498db, #9b59b6);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h2 {
            font-size: 2rem;
            color: #34495e;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
            padding: 15px;
            font-size: 1.1rem;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.8);
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #8e44ad;
            border-color: #8e44ad;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #9b59b6;
            transform: translateY(-3px);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(138, 44, 173, 0.5);
        }

        .alert {
            margin-top: 15px;
            text-align: center;
        }

        .forgot-password {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 10px;
            display: inline-block;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-link {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 10px;
            display: inline-block;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background-color: #3498db;
            color: white;
            border-radius: 50%;
        }

        .form-control:focus + .input-group-text {
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.8);
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="login" method="post">
                <?= csrf_field(); ?>
                
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mt-2">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <a href="/register" class="login-link">Don't have an account? Register here</a>
            <a href="#" class="forgot-password">Forgot your password?</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.min.js"></script>
</body>
</html>
