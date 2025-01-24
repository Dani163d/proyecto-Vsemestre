<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>OrientaPro</title>
    <link rel="stylesheet" href="{{ asset('css/carrera.css') }}">
</head>
<body>
    <!-- Modal de instrucciones -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="instructions-modal">
            <h2 class="instructions-title">¡Bienvenido a OrientaPro!</h2>
            <ul class="instructions-list">
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span>Explora las diferentes carreras disponibles y selecciona las que te interesen.</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span>Selecciona un mínimo de 3 carreras para poder realizar el test vocacional.</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span>Una vez seleccionadas las carreras, presiona el botón "Realizar test" para continuar.</span>
                </li>
            </ul>
            <button class="close-modal-btn" onclick="closeModal()">Entendido</button>
        </div>
    </div>

    <div class="theme-toggle">
        <i class="fas fa-sun"></i>
    </div>
    <div class="nav-toggle">
        <i class="fas fa-chevron-right"></i>
    </div>

    <nav class="navbar">
        <button class="nav-close">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="navbar-content">
            <div class="nav-logo">
                <i class="fas fa-compass"></i>
                <span>OrientaPro</span>
            </div>

            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Carreras</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span>Test</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <span>Resultados</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        <span>Estadisticas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            </ul>

            <div class="nav-footer">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-footer-link" style="cursor: pointer;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </a>
    </div>
    </nav>
    <h1 class="main-title">Explora tu Futuro Profesional</h1>

    <div class="careers-grid">
</div>

<div class="selected-count">
    <i class="fas fa-star"></i>
    <span>0 carreras seleccionadas</span>
    <button id="continueButton" class="continue-button" disabled>
        Realizar test
    </button>
</div>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/careers.js') }}"></script>
</body>
</html>