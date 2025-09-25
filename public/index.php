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
use MVC\Router;
$router=new Router();   
//Sin Authenticar
$router->get('/', [EmpresaController::class,'IndexUser']);
$router->get("/contacto", [ContactoController::class, "Index"]);
$router->get("/nosotros", [UsuarioController::class,"Nosotros"]);
$router->get('/empresa/panel', [EmpresaController::class, 'Public']);
$router->get('/user/convocatoria', [ConvocatoriaController::class, 'IndexUser']);

$router->get('/login', [LoginController::class,'login']);
$router->post('/login', [LoginController::class,'login']);
$router->get('/logout', [LoginController::class,'logout']);

//$router->get('/login', [AuthController::class, 'loginForm']);
//$router->post('/login', [AuthController::class, 'login']);

$router->get('/rol', [RolController::class, 'Index']);
//$router->get('/producto/crear', [ProductController::class, 'crear']);
$router->get('/usuario', [UsuarioController::class, 'Index']);
$router->get('/usuario/crear', [UsuarioController::class, 'Crear']);
$router->post('/usuario/crear', [UsuarioController::class, 'Crear']);


$router->get('/practica', [PracticaController::class, 'Index']);
$router->get('/postulacion', [PostulacionController::class, 'Index']);
$router->get('/estudiante', [EstudianteController::class, 'Index']);
$router->get('/empresa', [EmpresaController::class, 'Index']);
$router->get('/egresado', [EgresadoController::class, 'Index']);
$router->get('/convocatoria', [ConvocatoriaController::class, 'Index']);
$router->get('/asistencia', [AsistenciaController::class, 'Index']);

$router->ComprobarRutas();

?>