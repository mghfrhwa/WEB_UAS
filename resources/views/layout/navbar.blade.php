<nav class="navbar-custom">
    <div class="navbar-container">
        <div class="navbar-brand">
            <div class="brand-logo">
                <i class="fas fa-tools"></i>
            </div>
            <div class="brand-text">
                <span class="brand-main">Jaya Teknik</span>
                <span class="brand-sub">Engineering</span>
            </div>
        </div>

        <div class="navbar-menu">
            @if(Auth::check() && Auth::user()->peran == 'admin')
                {{-- MENU KHUSUS ADMIN --}}
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pesanan.index') }}" class="nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('bahan.index') }}" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Bahan</span>
                </a>
                <a href="{{ route('katalog.index') }}" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <span>Katalog</span>
                </a>
            
            @elseif(Auth::check() && Auth::user()->peran == 'customer')
                {{-- MENU KHUSUS CUSTOMER --}}
                <a href="{{ route('customer.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('customer.katalog') }}" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <span>Katalog Jasa</span>
                </a>
                <a href="{{ route('customer.cekKodeForm') }}" class="nav-link">
                    <i class="fas fa-search"></i>
                    <span>Lacak Pesanan</span>
                </a>
            @endif
        </div>

        <div class="navbar-right">
            <div class="navbar-user">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                    {{-- TAMPILKAN NAMA USER ASLI --}}
                    <div class="user-name">{{ Auth::user()->nama ?? 'User' }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->peran ?? 'Guest') }}</div>
                </div>
                
                <div class="custom-menu">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-circle"></i> Profil
                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </div>
            </div>

            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            @if(Auth::check() && Auth::user()->peran == 'admin')
                {{-- MOBILE ADMIN --}}
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('pesanan.index') }}" class="mobile-nav-link">
                    <i class="fas fa-clipboard-list"></i> <span>Pesanan</span>
                </a>
                <a href="{{ route('bahan.index') }}" class="mobile-nav-link">
                    <i class="fas fa-box"></i> <span>Bahan</span>
                </a>
                <a href="{{ route('katalog.index') }}" class="mobile-nav-link">
                    <i class="fas fa-cogs"></i> <span>Katalog</span>
                </a>

            @elseif(Auth::check() && Auth::user()->peran == 'customer')
                {{-- MOBILE CUSTOMER --}}
                <a href="{{ route('customer.dashboard') }}" class="mobile-nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('customer.katalog') }}" class="mobile-nav-link">
                    <i class="fas fa-book-open"></i> <span>Katalog Jasa</span>
                </a>
                <a href="{{ route('customer.cekKodeForm') }}" class="mobile-nav-link">
                    <i class="fas fa-search"></i> <span>Lacak Pesanan</span>
                </a>
            @endif
        </div>
    </div>
</nav>

<style>
    /* ============ VARIABLES ============ */
    :root {
        --primary-color: #3498db;
        --primary-dark: #2980b9;
        --secondary-color: #2c3e50;
        --accent-color: #1abc9c;
        --light-color: #ecf0f1;
        --dark-color: #34495e;
        --shadow: 0 4px 12px rgba(0,0,0,0.15);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* ============ NAVBAR UTAMA ============ */
    .navbar-custom {
        background: linear-gradient(135deg, var(--secondary-color), var(--dark-color));
        color: white;
        padding: 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: var(--shadow);
        border-bottom: 3px solid var(--accent-color);
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 30px;
        height: 70px;
    }

    /* ============ BRAND SECTION ============ */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        transition: var(--transition);
    }

    .navbar-brand:hover {
        transform: translateY(-1px);
    }

    .brand-logo {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        transition: var(--transition);
    }

    .navbar-brand:hover .brand-logo {
        transform: rotate(15deg);
        box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-main {
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: white;
    }

    .brand-sub {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--light-color);
        opacity: 0.9;
        letter-spacing: 1px;
    }

    /* ============ DESKTOP MENU ============ */
    .navbar-menu {
        display: flex;
        gap: 5px;
        margin: 0 30px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .nav-link:before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: var(--accent-color);
        transition: var(--transition);
        transform: translateX(-50%);
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }

    .nav-link:hover:before {
        width: 70%;
    }

    .nav-link i {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Active link styling */
    .nav-link.active {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .nav-link.active:before {
        width: 70%;
        background: var(--accent-color);
    }

    /* ============ RIGHT SECTION ============ */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* User Profile */
    .navbar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 12px;
        transition: var(--transition);
    }

    .navbar-user:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 700;
        font-size: 15px;
        color: white;
    }

    .user-role {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
    }

    /* === CUSTOM DROPDOWN MENU === */
    .custom-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        min-width: 200px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: var(--transition);
        z-index: 100;
        overflow: hidden;
    }

    /* Hover Effect untuk menampilkan menu */
    .navbar-user:hover .custom-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        color: var(--dark-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: var(--transition);
        border-left: 3px solid transparent;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        border-left-color: var(--primary-color);
        color: var(--primary-color);
    }

    .dropdown-item i {
        width: 20px;
        color: var(--dark-color);
        font-size: 16px;
    }

    .dropdown-item:hover i {
        color: var(--primary-color);
    }

    .dropdown-item.logout {
        color: #e74c3c;
    }

    .dropdown-item.logout:hover {
        background: #fef2f2;
        color: #e74c3c;
        border-left-color: #e74c3c;
    }

    .dropdown-item.logout:hover i {
        color: #e74c3c;
    }

    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        width: 45px;
        height: 45px;
        border-radius: 10px;
        cursor: pointer;
        transition: var(--transition);
        align-items: center;
        justify-content: center;
    }

    .mobile-menu-toggle:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* ============ MOBILE MENU ============ */
    .mobile-menu {
        display: none;
        background: white;
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        z-index: 999;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-100%);
        opacity: 0;
        transition: var(--transition);
    }

    .mobile-menu.active {
        transform: translateY(0);
        opacity: 1;
    }

    .mobile-menu-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 16px 20px;
        text-decoration: none;
        color: var(--dark-color);
        font-weight: 600;
        border-radius: 10px;
        transition: var(--transition);
    }

    .mobile-nav-link:hover {
        background: #f8f9fa;
        color: var(--primary-color);
        transform: translateX(5px);
    }

    .mobile-nav-link i {
        width: 24px;
        font-size: 18px;
        color: var(--dark-color);
    }

    .mobile-nav-link:hover i {
        color: var(--primary-color);
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 1024px) {
        .navbar-container {
            padding: 0 20px;
        }
        
        .navbar-menu {
            gap: 5px;
            margin: 0 15px;
        }
        
        .nav-link {
            padding: 12px 15px;
            font-size: 14px;
        }
    }

    @media (max-width: 900px) {
        .navbar-menu {
            display: none;
        }
        
        .mobile-menu-toggle {
            display: flex;
        }
        
        .navbar-user .user-info {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .navbar-container {
            padding: 0 15px;
            height: 60px;
        }
        
        .brand-main {
            font-size: 1.2rem;
        }
        
        .brand-sub {
            font-size: 0.75rem;
        }
        
        .brand-logo {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        
        .navbar-user {
            padding: 5px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }
        
        .mobile-menu {
            top: 60px;
        }
    }
</style>

<script>
// Toggle mobile menu
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const isActive = mobileMenu.classList.contains('active');
    
    if (isActive) {
        mobileMenu.classList.remove('active');
        setTimeout(() => {
            mobileMenu.style.display = 'none';
        }, 300);
    } else {
        mobileMenu.style.display = 'block';
        setTimeout(() => {
            mobileMenu.classList.add('active');
        }, 10);
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    
    if (mobileMenu.classList.contains('active') && 
        !mobileMenu.contains(event.target) && 
        !toggleBtn.contains(event.target)) {
        toggleMobileMenu();
    }
});

// Mark active link based on current URL
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
    
    navLinks.forEach(link => {
        // Simple check to mark active link
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">