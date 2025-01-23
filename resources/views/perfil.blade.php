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
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #818cf8;
            --background: #1e1b4b;
            --body-bg: #0f172a;
            --text: #f3f4f6;
            --hover: #6366f1;
        }

        [data-theme="light"] {
            --primary: #4f46e5;
            --secondary: #6366f1;
            --background: #f1f5f9;
            --body-bg: #ffffff;
            --text: #1e293b;
            --hover: #4338ca;
        }

        /* Tu CSS original aquí, solo cambié estas propiedades específicas */
        .navbar {
            background: var(--background);
            backdrop-filter: blur(10px);
        }

        body {
            background: var(--body-bg);
            color: var(--text);
        }

        .card-front,
        .card-back {
            background: var(--background);
        }

        /* Estilos para el botón de tema */
        .theme-toggle {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: #f79840;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            background: #f79840;
        }

        .theme-toggle i {
            color: var(--text);
            font-size: 1.2rem;
        }

        /* Asegúrate de que las transiciones sean suaves */
        * {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
    
</body>
</html>
<body>
    <!-- Botón de tema -->
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