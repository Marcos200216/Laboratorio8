<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,121,113,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .login-card h2 {
            margin-bottom: 2rem;
            font-weight: bold;
            text-align: center;
        }
        .login-card .form-label {
            font-weight: bold;
            color: #333;
        }
        .login-card .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 1rem;
            padding: 0.75rem;
            width: 100%;
        }
        .login-card .btn-primary:hover {
            background-color: #0056b3;
        }
        .login-card .form-text {
            text-align: center;
            margin-top: 1rem;
        }
        .login-card .form-text a {
            color: #007bff;
            text-decoration: none;
        }
        .login-card .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <h2>Login</h2>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="form-text mt-3">
                    Don't have an account? <a href="{{ route('register') }}">Register</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
