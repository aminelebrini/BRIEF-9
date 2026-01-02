<?php
namespace Core;

class Controller {
    public function render($view) {
        include __DIR__ . "/../Views/" . $view . ".php";
    }
}
