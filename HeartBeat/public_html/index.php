<?php

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

header("Content-Type: application/json");

require_once __DIR__ .  "/../vendor/autoload.php";

if (isset($_GET["url"])) {
    $url = explode("/", $_GET["url"]);

    if ($url[0] === "api") {
        array_shift($url);

        $controller = "App\Controllers\\" . ucfirst($url[0]) . "Controller";
        array_shift($url);

        $method = strtolower($_SERVER["REQUEST_METHOD"]);

        try {
            $response = call_user_func_array([new $controller, $method], $url);
            http_response_code(200);
            echo json_encode(["status" => "success", "data" => $response], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            echo json_encode(["status" => "error", "data" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
            throw new Exception();
        }
    }
} else {
    $domains = explode(".", $_SERVER["HTTP_HOST"]);
    if (count($domains) == 2) {
        // header("Location: ./pages/cliente.html");
    } else {
        header("Location: ./pages/index.html");
    }
}
