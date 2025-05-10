<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\ControllerFactory;

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$url = parse_url($requestUri, PHP_URL_PATH); // Loại bỏ query string

$routes = require_once __DIR__ . '/../app/Routes/web.php';

if (isset($routes[$url])) {

    ob_start();

    [$controllerClass, $method] = $routes[$url];

    // Gọi ControllerFactory để tạo controller
    $controller = ControllerFactory::create($controllerClass);

    $controller->$method();
    
    $content = ob_get_clean();

    require_once __DIR__ . '/../app/Views/partials/header.php';
    echo $content;
    require_once __DIR__ . '/../app/Views/partials/footer.php';
} else {
    http_response_code(404);
    echo "404 Not Found";
}
