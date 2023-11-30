<?php

header("Content-Type: application/json; charset=UTF-8");

include "../codelabmodul5/Routes/ProductsRoutes.php";

use app\Routes\ProductRoutes;

//Tangkap request method
$method = $_SERVER['REQUEST_METHOD'];
//TANGKAP REQUEST PATH
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//Panggil routes
$productRoutes = new ProductRoutes();
$productRoutes->handle($path, $method);