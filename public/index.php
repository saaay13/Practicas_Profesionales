<?php
require __DIR__ . '/../vendor/autoload.php';

use Controllers\AsistenciaController;
use Controllers\ConvocatoriaController;
use Controllers\EgresadoController;
use Controllers\EmpresaController;
use Controllers\EstudianteController;
use Controllers\PostulacionController;
use Controllers\PracticaController;
use Controllers\RolController;
use Controllers\UsuarioController;
use Controllers\ContactoController;
use Controllers\LoginController;
use Model\Postulacion;
use MVC\Router;

$router = new Router();

// =========================
// RUTAS SIN AUTENTICAR
// =========================
$router->get('/', [EmpresaController::class, 'IndexUser']);
$router->get('/mensaje/index', [ContactoController::class, 'Index']);
$router->get('/contacto/crear', [ContactoController::class, 'Crear']);
$router->post('/contacto/crear', [ContactoController::class, 'Crear']);
$router->get('/nosotros', [UsuarioController::class, 'Nosotros']);
$router->get('/error', [UsuarioController::class, 'Error']);
$router->get('/empresa/panel', [EmpresaController::class, 'Public']);
$router->get('/user/convocatoria', [ConvocatoriaController::class, 'IndexUser']);
$router->get('/empresa/misconvocatorias', [ConvocatoriaController::class, 'IndexConvocatorias']);
$router->get('/empresa/misempresas', [EmpresaController::class, 'IndexEmpresas']);
$router->get('/empresa/mispostulaciones', [PostulacionController::class, 'IndexPost']);
$router->get('/usuario/mispostulaciones', [PostulacionController::class, 'IndexPostula']);

// LOGIN / REGISTRO
$router->get('/login', [LoginController::class,'login']);
$router->post('/login', [LoginController::class,'login']);
$router->get('/logout', [LoginController::class,'logout']);
$router->get('/registro', [LoginController::class,'Insertar']);
$router->post('/registro', [LoginController::class,'Insertar']);

// ROL
$router->get('/rol', [RolController::class, 'Index']);

// USUARIO
$router->get('/usuario', [UsuarioController::class, 'Index']);
$router->get('/usuario/crear', [UsuarioController::class, 'Crear']);
$router->post('/usuario/crear', [UsuarioController::class, 'Crear']);
$router->get('/usuario/editar', [UsuarioController::class, 'Editar']);
$router->post('/usuario/editar', [UsuarioController::class, 'Editar']);
$router->get('/usuario/eliminar', [UsuarioController::class, 'Eliminar']);
// ASISTENCIA
$router->get('/asistencia', [AsistenciaController::class, 'Index']);
$router->get('/asistencia/crear', [AsistenciaController::class, 'Crear']);
$router->post('/asistencia/crear', [AsistenciaController::class, 'Crear']);
$router->get('/asistencia/editar', [AsistenciaController::class, 'Editar']);
$router->post('/asistencia/editar', [AsistenciaController::class, 'Editar']);
$router->get('/asistencia/eliminar', [AsistenciaController::class, 'Eliminar']);
$router->get('/asistencia/historial', [AsistenciaController::class, 'Historial']);
// PRACTICA
$router->get('/practica', [PracticaController::class, 'Index']);
$router->get('/practica/crear', [PracticaController::class, 'Crear']);
$router->post('/practica/crear', [PracticaController::class, 'Crear']);
$router->get('/practica/editar', [PracticaController::class, 'Editar']);
$router->post('/practica/editar', [PracticaController::class, 'Editar']);
$router->get('/practica/eliminar', [PracticaController::class, 'Eliminar']);
// POSTULACION
$router->get('/postulacion', [PostulacionController::class, 'Index']);
$router->get('/postulacion/crear', [PostulacionController::class, 'Crear']);
$router->post('/postulacion/crear', [PostulacionController::class, 'Crear']);
$router->get('/postulacion/editar', [PostulacionController::class, 'Editar']);
$router->post('/postulacion/editar', [PostulacionController::class, 'Editar']);
$router->get('/postulacion/eliminar', [PostulacionController::class, 'Eliminar']);
// ESTUDIANTE
$router->get('/estudiante', [EstudianteController::class, 'Index']);
$router->get('/estudiante/editar', [EstudianteController::class, 'Editar']);
$router->post('/estudiante/editar', [EstudianteController::class, 'Editar']);
// EMPRESA
$router->get('/empresa', [EmpresaController::class, 'Index']);
$router->get('/empresa/crear', [EmpresaController::class, 'Crear']);
$router->post('/empresa/crear', [EmpresaController::class, 'Crear']);
$router->get('/empresa/editar', [EmpresaController::class, 'Editar']);
$router->post('/empresa/editar', [EmpresaController::class, 'Editar']);
$router->get('/empresa/eliminar', [EmpresaController::class, 'Eliminar']);
// EGRESADO
$router->get('/egresado', [EgresadoController::class, 'Index']);
$router->get('/egresado/editar', [EgresadoController::class, 'Editar']);
$router->post('/egresado/editar', [EgresadoController::class, 'Editar']);
// CONVOCATORIA
$router->get('/convocatoria', [ConvocatoriaController::class, 'Index']);
$router->get('/convocatoria/crear', [ConvocatoriaController::class, 'Crear']);
$router->post('/convocatoria/crear', [ConvocatoriaController::class, 'Crear']);
$router->get('/convocatoria/editar', [ConvocatoriaController::class, 'Editar']);
$router->post('/convocatoria/editar', [ConvocatoriaController::class, 'Editar']);
$router->get('/convocatoria/eliminar', [ConvocatoriaController::class, 'Eliminar']);
// COMPROBAR RUTAS
$router->ComprobarRutas();

?>
