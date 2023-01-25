

<?php
$url = $_SERVER["QUERY_STRING"];

require('../Core/Router.php');


//instanciation de la class router
$router = new Router();

$router->add("", ["controller"=>"Retrieve", "action"=>"home"]);
$router->add("{controller}/{action}");
$router->add("admin/{controller}/{action}");
$router->add("{controller}/{id:\d+}/{action}");


// Rappel fonction macth()
$router->match($url);

// Rappel fonction dispatch()
$router->dispatch($url);
?>



