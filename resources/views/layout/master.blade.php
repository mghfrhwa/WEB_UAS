<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Bengkel Mesin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* === STYLE UMUM (DEFAULT / ADMIN) === */
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            /* Warna Background Default */
            background-color: #f2f2f2; 
            min-height: 100vh;
            /* Flex column agar footer selalu di bawah jika konten sedikit */
            display: flex;
            flex-direction: column;
        }

        /* === STYLE KHUSUS CUSTOMER (BACKGROUND FOTO) === */
        @if(Auth::check() && Auth::user()->peran == 'customer')
            body {
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
        @endif

        /* Container utama */
        .container-fluid {
            padding: 20px;
            margin-top: 85px; 
            max-width: 100%;
            /* Agar konten mengisi ruang kosong sebelum footer */
            flex: 1; 
        }

        .btn {
            background: #1a73e8;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background: #0d47a1;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        
        /* Reset style card agar transparan di layout utama */
        .container-fluid > .card {
            background: none;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }
    </style>
    <style>
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
    }

    .modal-content {
        background: white;
        width: 400px;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
    }
    </style>
</head>
<body>

    @include('layout.navbar')
    
    <div class="container-fluid">
        @include('layout.flash')

        @yield('content')
    </div>

    @include('layout.footer')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>