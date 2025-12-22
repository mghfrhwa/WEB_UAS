<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #e5e7eb;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo i {
            font-size: 2.5rem;
            color: #4f46e5;
            margin-bottom: 10px;
        }

        .logo h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            padding: 10px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }
        
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <i class="fas fa-tools"></i>
            <h3>Login Sistem</h3>
            <p class="text-muted">Masuk ke akun Anda</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" class="form-control" name="kata_sandi" placeholder="******" required>
                </div>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted" for="remember">Ingat saya</label>
            </div>
            
            <div class="d-grid gap-2 mb-4 mt-2">
                <button type="submit" class="btn btn-primary">
                    Masuk
                </button>
            </div>
            
            <div class="text-center">
                <p class="mb-0 text-muted">Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>