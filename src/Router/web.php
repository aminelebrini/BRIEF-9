<?php
use Core\Router;

$router = new Router();
$router->get("/", "Controllers\\HomeController@index");
$router->get("/display", "Controllers\\DisplayController@index");
$router->get("/admindash", "Controllers\\AdminController@index");
$router->get("/admindash", "Controllers\\AdminController@index");
$router->get("/author", "Controllers\\AuthorController@index");

$router->post("/login", "Controllers\\AuthentificationController@login");
$router->post("/signup", "Controllers\\AuthentificationController@signup");
$router->post('/logout', "Controllers\\AuthentificationController@logout");
$router->post("/add_category", "Controllers\\AdminController@add_category");
$router->post("/remove_category", "Controllers\\AdminController@remove_category");

$router->generate_path();
?>;