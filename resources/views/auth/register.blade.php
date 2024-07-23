<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,121,113,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Roboto', sans-serif;
        }
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-card {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .register-card h2 {
            margin-bottom: 2rem;
            font-weight: bold;
            text-align: center;
        }
        .register-card .form-label {
            font-weight: bold;
            color: #333;
        }
        .register-card .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 1rem;
            padding: 0.75rem;
            width: 100%;
        }
        .register-card .btn-primary:hover {
            background-color: #0056b3;
        }
        .register-card .form-text {
            text-align: center;
            margin-top: 1rem;
        }
        .register-card .form-text a {
            color: #007bff;
            text-decoration: none;
        }
        .register-card .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card register-card">
            <h2>Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <div class="form-text mt-3">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
