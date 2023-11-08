<?php
require_once './libs/Router.php';
require_once './App/Controllers/productos.controller.php';
<<<<<<< HEAD
require_once './App/Controllers/user.controller.php';
=======
require_once './App/Controllers/marcas.controller.php';
>>>>>>> 780d3ddcc7989cb19f217fce49732419a1841831

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('productos', 'GET', 'productosController', 'getProducts');
$router->addRoute('productos/:ID', 'GET', 'productosController', 'getProduct');
<<<<<<< HEAD
$router->addRoute('productos/', 'POST', 'productosController', 'GuardarProducto');
$router->addRoute('productos/:ID', 'DELETE', 'productosController', 'deleteProduct');
$router->addRoute('productos/:ID', 'PUT', 'productosController', 'updateProduct');
$router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'   );
=======
$router->addRoute('productos/:ID', 'DELETE', 'productosController', 'deleteProduct');
$router->addRoute('productos/:ID', 'PUT', 'productosController', 'actualizarProducto');
$router->addRoute('marcas', 'GET', 'marcasController', 'getMarcas');
$router->addRoute('marcas/:ID', 'GET', 'marcasController', 'getMarca');
$router->addRoute('marcas/:ID', 'PUT', 'marcasController','actualizarMarca');

>>>>>>> 780d3ddcc7989cb19f217fce49732419a1841831
 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);