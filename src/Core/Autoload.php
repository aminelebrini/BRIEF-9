<?php
spl_autoload_register(function($class){
    $classPath = str_replace('\\', '/', $class) . '.php';
    $fullPath = __DIR__ . '/../' . $classPath;

    if (file_exists($fullPath)) {
        require_once $fullPath;
    } else {
        echo "Classe non trouvée : $fullPath";
    }
});
