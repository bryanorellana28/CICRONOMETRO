<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login';


$route['login'] = 'login';
$route['login/autenticar'] = 'login/autenticar';


$route['salas'] = 'salas/index'; 
$route['salas/create'] = 'salas/create';
$route['salas/store'] = 'salas/store';
$route['salas/edit/(:num)'] = 'salas/edit/$1';
$route['salas/update/(:num)'] = 'salas/update/$1';
$route['salas/delete/(:num)'] = 'salas/delete/$1';





$route['clientes'] = 'clientes/index';
$route['clientes/create'] = 'clientes/create';
$route['clientes/store'] = 'clientes/store';
$route['clientes/edit/(:num)'] = 'clientes/edit/$1';
$route['clientes/update/(:num)'] = 'clientes/update/$1';
$route['clientes/delete/(:num)'] = 'clientes/delete/$1';


$route['usuarios'] = 'usuarios/index';
$route['usuarios/create'] = 'usuarios/create';
$route['usuarios/store'] = 'usuarios/store';
$route['usuarios/edit/(:num)'] = 'usuarios/edit/$1';
$route['usuarios/update/(:num)'] = 'usuarios/update/$1';
$route['usuarios/delete/(:num)'] = 'usuarios/delete/$1';


$route['paquetes'] = 'paquetes/index';
$route['paquetes/create'] = 'paquetes/create';
$route['paquetes/store'] = 'paquetes/store';
$route['paquetes/edit/(:num)'] = 'paquetes/edit/$1';
$route['paquetes/update/(:num)'] = 'paquetes/update/$1';
$route['paquetes/delete/(:num)'] = 'paquetes/delete/$1';


$route['estadisticas'] = 'estadisticas/index';



$route['dashboard'] = 'dashboard/index';
$route['dashboard/sala/(:num)'] = 'dashboard/sala/$1';
$route['dashboard/iniciar_cronometro'] = 'dashboard/iniciar_cronometro';
$route['dashboard/detener_cronometro'] = 'dashboard/detener_cronometro';




$route['cronometro/iniciar'] = 'cronometro/iniciar';
$route['dashboard'] = 'dashboard/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



