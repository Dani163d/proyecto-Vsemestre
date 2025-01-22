<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
<div class="container">
        <div class="form-container">
            <!-- Formulario de Login -->
            <div class="form signin-form">
                <h2>Iniciar Sesión</h2>
                <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                    <div class="col">
                        <label for="login-email">
                            <i class="fas fa-envelope"></i> Correo Electrónico:
                        </label>
                        <input type="email" id="login-email" name="CorreoUsuario" required>
                    </div>
                    <div class="col">
                        <label for="login-password">
                            <i class="fas fa-lock"></i> Contraseña:
                        </label>
                        <input type="password" id="login-password" name="ContrasenaUsuario" required>.
                        <a class="a" href="{{ route('recuperar-contraseña') }}">¿Olvidaste tu contraseña?</a>
                    </div>
                    <button class="boton-mobile" type="submit">Iniciar Sesión</button>

                    <div class="mobile-create-account mobile-only">
                        <button type="button" class="toggle-button" onclick="toggleForm()">Crear cuenta</button>
                    </div>
                </form>
            </div>

            <!-- Formulario de Registro -->
            <div class="form signup-form">
            <h2>Crear Cuenta</h2>
            <form action="{{ route('registro.submit') }}" method="POST">
            @csrf
                    <div class="row">
                        <div class="col">
                            <label for="nombres">
                                <i class="fas fa-user"></i> Nombres:
                            </label>
                            <input type="text" id="nombres" name="NombreUsuario" required>
                        </div>
                        <div class="col">
                            <label for="apellidos">
                                <i class="fas fa-user"></i> Apellidos:
                            </label>
                            <input type="text" id="apellidos" name="ApellidoUsuario" required>
                        </div>
                        <div class="col">
                            <label for="genero">
                                <i class="fas fa-venus-mars"></i>Genero:
                            </label>
                            <select id="genero" name="Generos_idGenero" required>
                                <option disabled selected>Seleccionar...</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero->idGenero }}">{{ $genero->NombreGenero }}</option>
                                @endforeach
                            </select>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="cedula">
                                <i class="fas fa-id-card"></i> Cédula:
                            </label>
                            <input type="text" id="cedula" name="CedulaUsuario" required>
                        </div>
                        <div class="col">
                            <label for="fecha_nacimiento">
                                <i class="fas fa-calendar-alt"></i> F. de Nacimiento:
                            </label>
                            <input type="date" id="fecha_nacimiento" name="FechaNacimientoUsuario" required>
                        </div>
                    </div>

                    <div class="col">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Correo Electrónico:
                        </label>
                        <input type="email" id="email" name="CorreoUsuario" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="clave">
                                <i class="fas fa-lock"></i> Contraseña:
                            </label>
                            <input type="password" id="clave" name="ContrasenaUsuario" required>
                        </div>
                        <div class="col">
                            <label for="confirm-clave">
                                <i class="fas fa-lock"></i> Confirmar la Contraseña:
                            </label>
                            <input type="password" id="confirm-clave" name="ContrasenaUsuario_confirmation" required>
                        </div>
                    </div>

                    <button class="boton-mobile" type="submit">Registrarse</button>

                    <div class="mobile-back-to-login mobile-only">
                        <button type="button" class="toggle-button" onclick="toggleForm()">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panel de Información para Sign In -->
        <div class="info-container info-signin">
            <h2>OrientaPro</h2>
            <p><i>¡Ingresa y descubre tu camino hacia el éxito profesional!</i></p>
            <h5>No te lo puedes perder</h5>
            <button type="button" class="toggle-button" onclick="toggleForm()">Crear cuenta</button>
        </div>

        <!-- Panel de Información para Sign Up -->
        <div class="info-container info-signup">
            <h2>¡Únete a OrientaPro!</h2>
            <p><i>Y descubre el poder de elegir el camino perfecto para ti.</i></p>
            <h5>Te esperamos</h5>
            <button type="button" class="toggle-button" onclick="toggleForm()">Iniciar Sesión</button>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Registro Exitoso!',
            text: 'Se ha enviado un correo de confirmación a tu correo',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if(session('verify_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Verificación Exitosa!',
            text: 'Tu correo ha sido verificado. Ahora puedes iniciar sesión.',
            confirmButtonText: 'Iniciar sesión'
        });
    </script>
@endif

@if(session('alert'))
    <script>
        Swal.fire({
            icon: "{{ session('alert.type') }}", 
            title: "{{ session('alert.message') }}",
            showConfirmButton: false,
            timer: 3000 
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Errores en el formulario",
            html: "<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>",
            showCloseButton: true
        });
    </script>
@endif

<script src="{{ asset('js/registro.js') }}"></script>

</body>
</html>