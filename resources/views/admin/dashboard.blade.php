<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Admin - OrientaPro</title>
    <link rel="stylesheet" href="{{ asset('css/carrera.css') }}">
</head>
<body>
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
                    <a href="{{ route('admin.carreras.index') }}" class="nav-link">
                        <i class="fas fa-briefcase"></i>
                        <span>Carreras</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs"></i>
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
        </div>
    </nav>

    <div class="admin-actions">
        <h1 class="main-title">Gestión de Carreras</h1>

        <!-- Botón para crear nueva carrera
        <button class="btn" onclick="window.location.href='{{ route('admin.carreras.create') }}'">Crear Carrera</button> -->

        <!-- Lista de carreras (por ejemplo) -->
        <div class="careers-list">
            @foreach ($carreras as $carrera)
                <div class="career-item">
                    <span class="career-name">{{ $carrera->nombre }}</span>
                    <a href="{{ route('admin.carreras.edit', $carrera->id) }}" class="btn">Editar</a>
                    <form action="{{ route('admin.carreras.destroy', $carrera->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/careers.js') }}"></script>
</body>
</html>
