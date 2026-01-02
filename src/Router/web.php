<?php
use Core\Router;

$router = new Router();
$router->get("/", "Controllers\\HomeController@index");
$router->generate_path();
?>