<?php

use App\Controllers\CustomerController;
use App\Controllers\EmployeeController;
use App\Controllers\HomeController;
use App\Controllers\MyGroupController;
use App\Routes\Router;

$router = new Router();

// Головна сторінка
$router->addRoute('GET', '/', HomeController::class, 'index');

// Замовлення
$router->addRoute('GET', '/customer', CustomerController::class, 'index');

// Пошук замовлень
$router->addRoute('GET', '/employee', EmployeeController::class, 'index');
$router->addRoute('GET', '/employee/search', EmployeeController::class, 'search');

// Робота з групою
$router->addRoute('GET', '/mygroup', MyGroupController::class, 'index');
$router->addRoute('GET', '/mygroup/create', MyGroupController::class, 'create');
$router->addRoute('POST', '/mygroup/create', MyGroupController::class, 'create');
$router->addRoute('POST', '/mygroup/update', MyGroupController::class, 'update');

// Обробка
$router->dispatch();
?>