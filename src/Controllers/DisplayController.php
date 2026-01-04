<?php

namespace Controllers;

use Core\Controller;

class DisplayController extends Controller
{
    public function index()
    {
        $this->render("display",
            [
                "title" => 'Les articles',
            ]
        );
    }
}

?>