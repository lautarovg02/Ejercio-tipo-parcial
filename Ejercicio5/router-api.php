<?php
require_once 'libs/Router.php';
require_once 'apiController.php';

// creo el router
$router = new Router();

// tabla de ruteo
$router->addRoute('vuelos/:NRO_VUELO', 'GET', 'apiController','getFlight');
$router->addRoute('vuelos/ciudad', 'GET', 'apiController','getCities');
$router->addRoute('vuelos', 'POST', 'apiController','sendFlight');;
$router->addRoute('vuelos', 'GET', 'apiController','flights');


// rutea

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);