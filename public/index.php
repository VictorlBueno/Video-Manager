<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    NewVideoController,
    VideoFormController,
    VideoListController
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

// Chama routes e retorna uma lista chave/valor
$routes = require_once __DIR__ . '/../config/routes.php';

// Coleta os dados da requisição
$httpMethod = $_SERVER['REQUEST_METHOD'];
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

session_start();
session_regenerate_id();
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

// Passa parâmetros
$key = "$httpMethod|$pathInfo";
if(array_key_exists($key, $routes)) {
    // Pega o return específico da chave
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    // Pega o valor específico
    $controller = new $controllerClass($videoRepository);

} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processaRequisicao();
