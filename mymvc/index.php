<?php
require_once('route.php');
require_once('controller/home_controller.php');

$home = new HomeController();

switch ($request) {
    case 'home':
        $home->index();
    break;

    default:
        http_response_code(404);
        echo '404 NOT FOUND';
}
?>