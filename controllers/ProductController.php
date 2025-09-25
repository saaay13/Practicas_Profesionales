<?php
namespace Controllers;
use MVC\Router;
class ProductController
{
    public static function Index(Router $router)  
    {
        echo "<br>INDEX";
        $router ->render ("home",[
            "titulo"=> "bienvenido",
            "mensaje"=> "vista"
        ]);
    }
    public static function Prueba(): void
    {
        echo "Estas en prueba";
    }


}
