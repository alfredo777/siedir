<?php
// index.php - Página de arranque SIEDR
session_start();
date_default_timezone_set('America/Mexico_City');
$current_year = date('Y');
$current_date = date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIEDR Puebla - Sistema Integral de Inteligencia Electoral y Desarrollo Regional">
    <meta name="keywords" content="SIEDR, Puebla, Electoral, Inteligencia, Política">
    <meta name="author" content="SIEDR Puebla">
    <title>SIEDR Puebla - Sistema Integral de Inteligencia Electoral</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a1a2e;
            --secondary: #16213e;
            --accent: #e94560;
            --light: #f5f5f5;
            --white: #ffffff;
            --success: #00d4aa;
            --warning: #ffa726;
            --info: #29b6f6;
            --gradient-dark: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            --gradient-accent: linear-gradient(135deg, #e94560 0%, #ff6b6b 100%);
            --gradient-hero: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --shadow: 0 20px 40px rgba(0,0,0,0.1);
            --shadow-sm: 0 10px 20px rgba(0,0,0,0.08);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--gradient-dark);
            color: var(--primary);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Loading Screen */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            width: 100px;
            height: 100px;
            background: var(--white);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .loader-logo i {
            font-size: 3em;
            color: var(--accent);
        }

        .loader-text {
            color: var(--white);
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .loader-bar {
            width: 200px;
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
            overflow: hidden;
            margin: 0 auto;
        }

        .loader-bar-fill {
            height: 100%;
            background: var(--gradient-accent);
            border-radius: 2px;
            animation: loadingBar 2s ease-in-out infinite;
        }

        @keyframes loadingBar {
            0% { width: 0%; }
            50% { width: 100%; }
            100% { width: 0%; }
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(20px);
            padding: 1rem 2rem;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.75rem 2rem;
            box-shadow: var(--shadow);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--white);
        }

        .nav-logo i {
            font-size: 2rem;
            color: var(--accent);
        }

        .nav-logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .nav-info {
            display: flex;
            align-items: center;
            gap: 2rem;
            color: var(--white);
            font-size: 0.9rem;
        }

        .nav-info span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 2rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            animation: slideGrid 20s linear infinite;
        }

        @keyframes slideGrid {
            0% { transform: translate(0, 0); }
            100% { transform: translate(100px, 100px); }
        }

        .hero-content {
            max-width: 1200px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-text .gradient-text {
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.25rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--gradient-accent);
            color: var(--white);
            box-shadow: 0 10px 30px rgba(233, 69, 96, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(233, 69, 96, 0.4);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.2);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
            border-color: var(--accent);
        }

        .btn i {
            font-size: 1.2rem;
            position: relative;
            z-index: 1;
        }

        .btn span {
            position: relative;
            z-index: 1;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
        }

        .visual-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .visual-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(233,69,96,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .visual-icon {
            font-size: 8rem;
            color: var(--accent);
            text-align: center;
            margin-bottom: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .visual-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--white);
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Features Section */
        .features {
            padding: 4rem 2rem;
            background: var(--white);
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .features-header h2 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .features-header p {
            font-size: 1.2rem;
            color: #666;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            text-align: center;
            border: 1px solid #f0f0f0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
            border-color: var(--accent);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
        }

        .feature-card h3 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: var(--gradient-dark);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .footer-info span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-divider {
            width: 100px;
            height: 2px;
            background: var(--gradient-accent);
            margin: 2rem auto;
        }

        .footer-copyright {
            opacity: 0.6;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .nav-info {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .nav-logo-text {
                font-size: 1.2rem;
            }

            .hero {
                padding: 5rem 1rem 2rem;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text p {
                font-size: 1rem;
            }

            .btn {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }

            .visual-card {
                padding: 2rem;
            }

            .visual-icon {
                font-size: 5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .features-header h2 {
                font-size: 2rem;
            }

            .footer-info {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-text h1 {
                font-size: 1.75rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .visual-stats {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-left {
            opacity: 0;
            transform: translateX(-50px);
            animation: slideLeft 1s ease forwards;
        }

        @keyframes slideLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-right {
            opacity: 0;
            transform: translateX(50px);
            animation: slideRight 1s ease forwards;
        }

        @keyframes slideRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            animation: scaleIn 0.8s ease forwards;
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Particles Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: floatParticle 20s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="loader-logo">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div class="loader-text">Cargando SIEDR Puebla...</div>
            <div class="loader-bar">
                <div class="loader-bar-fill"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <i class="fas fa-chart-pie"></i>
                <span class="nav-logo-text">SIEDR Puebla</span>
            </a>
            <div class="nav-info">
                <span>
                    <i class="fas fa-map-marker-alt"></i>
                    217 Municipios
                </span>
                <span>
                    <i class="fas fa-users"></i>
                    6.6M Habitantes
                </span>
                <span>
                    <i class="fas fa-calendar"></i>
                    <?php echo $current_date; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="particles" id="particles"></div>
        <div class="hero-content">
            <div class="hero-grid">
                <div class="hero-text slide-left">
                    <h1>
                        Sistema Integral de<br>
                        <span class="gradient-text">Inteligencia Electoral</span>
                    </h1>
                    <p>
                        Revolucione la gestión política del Estado de Puebla con tecnología de punta, 
                        análisis predictivo con IA y cobertura total de los 217 municipios.
                    </p>
                    <div class="hero-buttons">
                        <a href="presentacion.html" class="btn btn-primary">
                            <i class="fas fa-play-circle"></i>
                            <span>Ver Presentación</span>
                        </a>
                        <a href="reporte.html" class="btn btn-secondary">
                            <i class="fas fa-file-alt"></i>
                            <span>Ejemplo de Reporte</span>
                        </a>
                    </div>
                </div>
                <div class="hero-visual slide-right">
                    <div class="visual-card">
                        <div class="visual-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="visual-stats">
                            <div class="stat-item">
                                <span class="stat-number">217</span>
                                <span class="stat-label">Municipios</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4.9M</span>
                                <span class="stat-label">Electores</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">26</span>
                                <span class="stat-label">Distritos</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">98%</span>
                                <span class="stat-label">Precisión</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <div class="features-header fade-in">
                <h2>Capacidades del Sistema</h2>
                <p>Tecnología avanzada para la gestión política moderna</p>
            </div>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Inteligencia Artificial</h3>
                    <p>Análisis predictivo y generación automática de reportes con IA de última generación</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Big Data</h3>
                    <p>Procesamiento de millones de registros con tecnología de alto rendimiento</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Mapas Interactivos</h3>
                    <p>Visualización territorial completa con datos en tiempo real</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h3>CRM Electoral</h3>
                    <p>Gestión integral de 4.9 millones de electores del estado</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Seguridad Total</h3>
                    <p>Encriptación AES-256 y auditoría completa de accesos</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Acceso Móvil</h3>
                    <p>Consulte desde cualquier dispositivo en tiempo real</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">SIEDR Puebla</div>
            <div class="footer-info">
                <span>
                    <i class="fas fa-envelope"></i>
                    contacto@siedr-puebla.mx
                </span>
                <span>
                    <i class="fas fa-phone"></i>
                    +52 222 123 4567
                </span>
                <span>
                    <i class="fas fa-globe"></i>
                    www.siedr-puebla.mx
                </span>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-copyright">
                © <?php echo $current_year; ?> SIEDR Puebla. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script>
        // Hide loader after page loads
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loader').classList.add('hidden');
            }, 1500);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Create animated particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        createParticles();

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.fade-in, .slide-left, .slide-right, .scale-in').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effect to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Dynamic stats animation
        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');
            
            stats.forEach(stat => {
                const target = stat.innerText;
                if (target.includes('M')) {
                    const num = parseFloat(target);
                    let current = 0;
                    const increment = num / 100;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= num) {
                            stat.innerText = target;
                            clearInterval(timer);
                        } else {
                            stat.innerText = current.toFixed(1) + 'M';
                        }
                    }, 20);
                } else if (target.includes('%')) {
                    const num = parseInt(target);
                    let current = 0;
                    const increment = num / 100;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= num) {
                            stat.innerText = target;
                            clearInterval(timer);
                        } else {
                            stat.innerText = Math.floor(current) + '%';
                        }
                    }, 20);
                } else {
                    const num = parseInt(target);
                    let current = 0;
                    const increment = num / 100;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= num) {
                            stat.innerText = target;
                            clearInterval(timer);
                        } else {
                            stat.innerText = Math.floor(current);
                        }
                    }, 20);
                }
            });
        }

        // Trigger stats animation when visible
        const statsSection = document.querySelector('.hero-visual');
        const statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        statsObserver.observe(statsSection);

        // Mobile menu functionality (if needed)
        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Adjust animations for mobile
        if (isMobile()) {
            document.querySelectorAll('.particle').forEach(particle => {
                particle.style.width = '2px';
                particle.style.height = '2px';
            });
        }

        // Print current PHP version info (for debugging)
        console.log('SIEDR Puebla - Sistema Cargado');
        console.log('PHP Version: <?php echo phpversion(); ?>');
        console.log('Fecha: <?php echo $current_date; ?>');
    </script>
</body>
</html>