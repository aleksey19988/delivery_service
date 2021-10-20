<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$view = new Environment($loader);

$config = include 'config/database.php';
['dsn' => $dsn, 'username' => $username, 'password' => $password] = $config;

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database error: ' . $exception->getMessage();
    die();
}

$app = AppFactory::create();
$app->setBasePath('/delivery_service');

$app->get('/', function (Request $request, Response $response, $args) use ($view, $connection) {
    $orders = new Orders($connection);
    $body = $view->render('index.twig', [
        'orders' => $orders,
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->run();
