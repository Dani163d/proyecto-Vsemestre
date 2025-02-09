<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RamasController;
use App\Http\Controllers\RespuestaSeguridadController;
use App\Http\Controllers\RecuperarContrasenaController;

//  Rutas de Registro
Route::get('/', [RegistroController::class, 'showRegistrationForm'])->name('registro');
Route::post('/', [RegistroController::class, 'showRegistrationForm'])->name('registro.submit');
Route::post('registro', [RegistroController::class, 'register'])->name('registro.submit');
Route::get('/registro', [RegistroController::class, 'showRegistrationForm'])->name('registro');


// Verificación de correo
Route::get('/verificar-correo', [RegistroController::class, 'verificarCorreo'])->name('verificar.correo');
Route::post('/verificar-correo', [RegistroController::class, 'verificarCorreo'])->name('verificar.correo');
Route::get('/verificar', [RegistroController::class, 'verificarCorreo'])->name('verificar.email');

// Rutas de Login 
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// Rutas de Perfil 
Route::post('logout', [PerfilController::class, 'logout'])->name('logout');
Route::get('/perfil', [PerfilController::class, 'perfil'])->name('perfil');
Route::post('/perfil', [PerfilController::class, 'perfil'])->name('perfil.submit');

// Respuestas de Seguridad
Route::post('/respuesta-seguridad/store', [RespuestaSeguridadController::class, 'store'])->name('respuesta-seguridad.store');

//Rutas de Autenticación
Route::get('/verify-email/{token}', [AuthController::class, 'verificarEmail'])->name('verify.email');

// Guardar respuestas de seguridad
Route::post('/guardar-respuestas', [AuthController::class, 'guardarRespuestasSeguridad'])->name('guardar.respuestas')->middleware('auth');
Route::get('/guardar-respuestas', [AuthController::class, 'guardarRespuestasSeguridad'])->name('guardar.respuestas')->middleware('auth');

// Rutas de Recuperación de Contraseña

// Verificar correo y enviar enlace de recuperación
Route::post('/verificar-correo-preguntas', [RecuperarContrasenaController::class, 'verificarCorreoPreguntas'])->name('verificar.correo.preguntas');
Route::post('/enviar-enlace-recuperacion', [RecuperarContrasenaController::class, 'enviarEnlaceRecuperacion'])->name('enviar.enlace.recuperacion');

// Resetear contraseña con token
Route::get('/reset-password/{token}', [RecuperarContrasenaController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [RecuperarContrasenaController::class, 'resetPassword'])->name('password.update');


// Mostrar preguntas de seguridad
Route::get('/mostrar-preguntas/{userId}', [RecuperarContrasenaController::class, 'mostrarPreguntasSeguridad'])->name('mostrar.preguntas');

// Mostrar formulario de preguntas de seguridad
Route::get('/preguntas-seguridad/{userId}', [RecuperarContrasenaController::class, 'mostrarFormularioPreguntas'])->name('preguntas.seguridad');

// Mostrar formulario de cambio de contraseña
Route::get('/cambiar-contrasena', [RecuperarContrasenaController::class, 'mostrarFormularioCambioContrasena'])->name('mostrar.cambio.contrasena');
Route::get('/cambio-contrasena/{userId}', [RecuperarContrasenaController::class, 'mostrarFormularioCambioContrasena'])->name('cambio.contrasena');

// Cambiar contraseña
Route::post('/cambiar-contrasena', [RecuperarContrasenaController::class, 'cambiarContrasena'])->name('actualizar.contrasena');

// Validar respuestas de seguridad
Route::post('/validar-respuestas', [RecuperarContrasenaController::class, 'validarRespuestas'])->name('validar.respuestas');
Route::post('/verificar-respuestas-seguridad', [RecuperarContrasenaController::class, 'verificarRespuestasSeguridad'])->name('verificar.respuestas');

// Actualizar contraseña después de verificación
Route::post('/actualizar-contrasena', [RecuperarContrasenaController::class, 'actualizarContrasena'])->name('actualizar.contrasena');

// ** Ruta para Mostrar Formulario de Recuperación **
Route::get('recuperar-contraseña', function() {
    return view('recuperar-contrasena');
})->name('recuperar-contraseña');

Route::get('/ramas/{carrera}', [RamasController::class, 'showBranches'])->name('ramas.show');



use App\Http\Controllers\CarreraController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Ruta para ver todas las carreras
    Route::get('admin/carreras', [CarreraController::class, 'index'])->name('admin.carreras.index');
    
    // Ruta para crear una carrera
    Route::get('admin/carreras/create', [CarreraController::class, 'create'])->name('admin.carreras.create');
    Route::post('admin/carreras', [CarreraController::class, 'store'])->name('admin.carreras.store');

    // Ruta para editar una carrera
    Route::get('admin/carreras/{carrera}/edit', [CarreraController::class, 'edit'])->name('admin.carreras.edit');
    Route::put('admin/carreras/{carrera}', [CarreraController::class, 'update'])->name('admin.carreras.update');

    // Ruta para eliminar una carrera
    Route::delete('admin/carreras/{carrera}', [CarreraController::class, 'destroy'])->name('admin.carreras.destroy');
});

Route::middleware('role:admin')->group(function () {
    Route::resource('admin/carreras', CarreraController::class);
});

Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function() {
    Route::resource('carreras', CarreraController::class);
});

Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])
    ->name('admin.dashboard')
    ->middleware('role:admin');