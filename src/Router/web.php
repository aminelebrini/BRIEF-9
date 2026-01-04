<?php
use Core\Router;

$router = new Router();
$router->get("/", "Controllers\\HomeController@index");
$router->get("/display", "Controllers\\DisplayController@index");


$router->post("/login", "Controllers\\AuthentificationController@login");
$router->post("/signup", "Controllers\\AuthentificationController@signup");

$router->generate_path();
?>