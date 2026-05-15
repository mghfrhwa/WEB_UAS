<footer class="footer-custom">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="footer-brand">
                        <i class="fas fa-tools"></i>
                        <span>Jaya Teknik Engineering</span>
                    </div>
                    <p class="footer-description">
                        Solusi engineering terpercaya untuk kebutuhan mekanikal dan konstruksi dengan kualitas terbaik dan layanan profesional.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <h5 class="footer-title">Layanan Kami</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-drafting-compass"></i> Perancangan</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> Pengerjaan Komponen</a></li>
                    <li><a href="#"><i class="fas fa-industry"></i> Perakitan Mesin</a></li>
                    <li><a href="#"><i class="fas fa-clipboard-check"></i> Uji Coba </a></li>
                    <li><a href="#"><i class="fas fa-paint-roller"></i> Finishing</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h5 class="footer-title">Tautan Cepat</h5>
                <ul class="footer-links">
                    @auth
                        @if(auth()->user()->peran === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                            <li><a href="{{ route('pesanan.index') }}"><i class="fas fa-clipboard-list"></i> Manajemen Pesanan</a></li>
                            <li><a href="{{ route('bahan.index') }}"><i class="fas fa-box"></i> Manajemen Bahan</a></li>
                            <li><a href="{{ route('katalog.index') }}"><i class="fas fa-cogs"></i> Katalog Produk</a></li>
                        @else
                            <li><a href="{{ route('customer.dashboard') }}"><i class="fas fa-home"></i> Dashboard Saya</a></li>
                            <li><a href="{{ route('customer.katalog') }}"><i class="fas fa-images"></i> Lihat Katalog</a></li>
                            <li><a href="{{ route('customer.cekKodeForm') }}"><i class="fas fa-search"></i> Lacak Pesanan</a></li>
                        @endif
                        <li><a href="#" onclick="showProfileModal()"><i class="fas fa-user-circle"></i> Profil Saya</a></li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Daftar</a></li>
                    @endauth
                    <li><a href="#contact"><i class="fas fa-phone-alt"></i> Kontak Kami</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h5 class="footer-title">Kontak Kami</h5>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Alamat Kantor</strong>
                            <p>Jl. Bulusan, Desa Bulu, Kec. Semen</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Telepon / WA</strong>
                            <p>0856-4671-2902</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p>jayateknikenginering@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Jam Operasional</strong>
                            <p>Senin - Jumat: 08:00 - 17:00</p>
                            <p>Sabtu: 08:00 - 14:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; {{ date('Y') }} <strong>Jaya Teknik Engineering</strong>. Hak Cipta Dilindungi.</p>
                <p class="version">Sistem Manajemen Proyek Pengabdian Masyarakat</p>
            </div>

            <div class="footer-bottom-links">
                <a href="#">Kebijakan Privasi</a>
                <span class="separator">|</span>
                <a href="#">Syarat & Ketentuan</a>
                <span class="separator">|</span>
                <a href="#top"><i class="fas fa-arrow-up"></i> Kembali ke Atas</a>
            </div>
        </div>
    </div>

    <div class="live-support">
        <button class="support-btn" onclick="openSupportChat()">
            <i class="fab fa-whatsapp"></i>
            <span class="support-text">Butuh Bantuan?</span>
        </button>
    </div>
</footer>

<style>
    /* ============ VARIABLES ============ */
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #1abc9c;
        --dark-color: #34495e;
    }

    /* ============ FOOTER UTAMA ============ */
    .footer-custom {
        background: linear-gradient(135deg, var(--secondary-color), var(--dark-color));
        color: white;
        padding: 60px 0 20px;
        margin-top: auto;
        position: relative;
        overflow: hidden;
    }

    .footer-custom:before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ============ FOOTER TOP ============ */
    .footer-top {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .footer-section { padding: 0 10px; }

    /* Logo & Brand */
    .footer-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
    }
    .footer-brand i { color: var(--accent-color); font-size: 1.8rem; }
    .footer-description {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    /* Social Links */
    .social-links { display: flex; gap: 10px; }
    .social-link {
        width: 36px; height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: white; text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .social-link:hover {
        background: var(--primary-color);
        transform: translateY(-3px);
    }

    /* Titles & Links */
    .footer-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: white;
        position: relative;
        padding-bottom: 10px;
    }
    .footer-title:after {
        content: '';
        position: absolute; bottom: 0; left: 0;
        width: 40px; height: 3px;
        background: var(--accent-color);
        border-radius: 2px;
    }

    .footer-links { list-style: none; padding: 0; margin: 0; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        display: flex; align-items: center; gap: 10px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    .footer-links a:hover {
        color: var(--accent-color);
        transform: translateX(5px);
    }
    .footer-links a i { width: 20px; color: var(--accent-color); font-size: 0.9rem; }

    /* Contact Info */
    .contact-info { display: flex; flex-direction: column; gap: 15px; }
    .contact-item { display: flex; align-items: flex-start; gap: 12px; }
    .contact-item i {
        color: var(--accent-color);
        font-size: 1.1rem;
        margin-top: 3px;
        min-width: 20px;
    }
    .contact-item strong { display: block; color: white; font-size: 0.9rem; }
    .contact-item p { margin: 0; font-size: 0.85rem; color: rgba(255,255,255,0.8); }

    /* ============ FOOTER BOTTOM ============ */
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .copyright p { color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin: 0; }
    .version { font-size: 0.8rem; opacity: 0.7; margin-top: 5px; }

    .footer-bottom-links { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
    .footer-bottom-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.3s;
    }
    .footer-bottom-links a:hover { color: var(--accent-color); }
    .separator { color: rgba(255, 255, 255, 0.3); font-size: 12px; }

    /* ============ LIVE SUPPORT ============ */
    .live-support {
        position: fixed; bottom: 30px; right: 30px; z-index: 1000;
    }
    .support-btn {
        background: #25D366; /* Warna WA */
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 50px;
        cursor: pointer;
        display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        transition: all 0.3s;
        font-weight: 600;
        animation: pulse 2s infinite;
    }
    .support-btn:hover {
        background: #128C7E;
        transform: translateY(-3px);
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }

    /* Responsif */
    @media (max-width: 768px) {
        .footer-top { grid-template-columns: 1fr; gap: 30px; }
        .footer-bottom { flex-direction: column; text-align: center; }
        .footer-bottom-links { justify-content: center; }
        .support-text { display: none; }
        .support-btn { width: 50px; height: 50px; padding: 0; justify-content: center; }
        .support-btn i { font-size: 1.5rem; }
    }
</style>

<script>
    // Scroll to top
    document.querySelector('a[href="#top"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Support Chat (WA)
    function openSupportChat() {
        const message = "Halo Admin Jaya Teknik, saya butuh bantuan.";
        const phone = "6285646712902";
        const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }
</script>
