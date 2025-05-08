<?php
namespace App\Controllers;

class Controller
{
    public function render($view, $data = [])
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../Views/$view.php";
        $content = ob_get_clean();
        require __DIR__ . "/../Views/layout.php";
    }
}