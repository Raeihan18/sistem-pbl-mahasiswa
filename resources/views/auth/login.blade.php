<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem PBL Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .login-card .card-body {
            padding: 2rem;
        }
        .login-card .logo {
            width: 100px;
            margin-bottom: 1rem;
        }
        .btn-login {
            background: #4e73df;
            color: #fff;
            font-weight: bold;
        }
        .btn-login:hover {
            background: #2e59d9;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card login-card shadow">
                <div class="card-body text-center">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo">
                    <h4 class="mb-3">Sistem PBL Mahasiswa</h4>
                    <p class="text-muted mb-4">Masuk untuk mengelola data dan nilai mahasiswa</p>

                    @if($errors->any())
                        <div class="alert alert-danger text-start">
                            <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login btn-lg">Login</button>
                        </div>

                        <div class="text-muted">
                            &copy; {{ date('Y') }} Sistem PBL Mahasiswa
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
