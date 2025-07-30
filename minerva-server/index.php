<?php
    namespace Minerva\Testing;

    require_once __DIR__ . '/src/validation.php';
    require_once __DIR__ . '/src/testing.php';
    require_once __DIR__ . '/src/Router.php';

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    permitRequest('GET');
    checkRequest($_SERVER['REQUEST_METHOD']);

    $endpoints = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $endpoints = array_slice($endpoints, 2);

    $target = $_GET['target'] ?? '';
    $target = htmlspecialchars($target, ENT_QUOTES, 'UTF-8');
    checkString($target);

    $target = rtrim($target, '/');
    $response = minerva_service_heartbeats($target);
    echo json_encode($response);

    exit(0);