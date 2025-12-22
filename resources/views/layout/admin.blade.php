<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        .navbar { background: #333; padding: 15px; color: white; margin-bottom: 20px; }
        .btn {
            background: #1a73e8; padding: 10px 15px;
            color: white; text-decoration:none;
            border-radius: 5px;
        }
        .btn:hover { background:#0d47a1; }
        .card { background:white; padding:20px; border-radius:8px; }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Admin Panel Bengkel Mesin</h2>
</div>

<div class="card">
    @yield('content')
</div>

</body>
</html>
