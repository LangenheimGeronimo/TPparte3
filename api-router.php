<?php 

require_once 'libs/Router.php';
require_once 'ApiController.php';

$router = new Router();
// REQUISITOS OBLIGATORIOS:

// ASESINOS
// Listar Todos
$router->addRoute('asesinos','GET','ApiController','traerAsesinos');
// Listar por ID
$router->addRoute('asesinos/:ID','GET','ApiController','traerAsesino');
// Ordenar por columna y orden(ASC o DESC)
$router->addRoute('asesinos/ordenarPor/:COLUMNA/:ORDEN','GET','ApiController','ordenarAsesinosPor');
// Agregar asesino
$router->addRoute('asesinos', 'POST', 'ApiController', 'agregar_editar_asesino');
// Editar asesino
$router->addRoute('asesinos/:ID', 'PUT', 'ApiController', 'agregar_editar_asesino');

//VICTIMAS
// Listar Todos
$router->addRoute('victimas','GET','ApiController','traerVictimas');
// Listar por ID
$router->addRoute('victimas/:ID','GET','ApiController','traerVictimas');
// Ordenar por columna y orden(ASC o DESC)
$router->addRoute('victimas/ordenarPor/:COLUMNA/:ORDEN','GET','ApiController','ordenarVictimasPor');
// Agregar victima
$router->addRoute('victimas', 'POST', 'ApiController', 'agregar_editar_victimas');
// Editar victima
$router->addRoute('victimas/:ID', 'PUT', 'ApiController', 'agregar_editar_victimas');
// --------------------------------------------------------------------------------------------



// REQUISITOS OPCIONALES (ASESINOS)
//Borrar asesino
$router->addRoute('asesinos/:ID', 'DELETE', 'Apicontroller', 'BorrarAsesinato');
// filtrar por edad
$router->addRoute('asesinos/edad/:DESDE/:HASTA','GET','ApiController','filtrarPorEdad');
// filtrar por genero
$router->addRoute('asesinos/genero/:GENERO','GET','ApiController','filtrarPorGenero');
// filtrar por peso
$router->addRoute('asesinos/peso/:DESDE/:HASTA','GET','ApiController','filtrarPorPeso');
// filtrar por altura
$router->addRoute('asesinos/altura/:DESDE/:HASTA','GET','ApiController','filtrarPorAltura');

// REQUISITOS OPCIONALES (victimas)
//Borrar victima
$router->addRoute('victimas/:ID', 'DELETE', 'Apicontroller', 'BorrarVictimaDeAsesino');
// filtrar por edad
$router->addRoute('victimas/edad/:DESDE/:HASTA','GET','ApiController','filtrarVictimasPorEdad');
// filtrar por genero
$router->addRoute('victimas/genero/:GENERO','GET','ApiController','filtrarVictimaPorGenero');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


?>