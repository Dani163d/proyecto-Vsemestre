<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Navbar Ovalado</title>
    <link rel="stylesheet" href="{{ asset('css/carrera.css') }}">
</head>
<body>
    <div class="nav-toggle">
        <i class="fas fa-chevron-right"></i>
    </div>

    <nav class="navbar">
        <button class="nav-close">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="navbar-content">
            <div class="nav-logo">
                <i class="fas fa-code"></i>
                <span>DevNav</span>
            </div>

            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <span>Proyectos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        <span>Mensajes</span>
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
                <a href="#" class="nav-footer-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </div>
    </nav>
    <h1 class="main-title">Explora tu Futuro Profesional</h1>

    <div class="careers-grid">
    </div>

    <div class="selected-count">
        <i class="fas fa-star"></i>
        <span>0 carreras seleccionadas</span>
    </div>
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/careers.js') }}"></script>
</body>
</html>