<?php
    namespace Minerva\Testing;

    require_once __DIR__ . '/utils/validation.php';
    require_once __DIR__ . '/utils/testing.php';

    header("Content-Type: application/json; charset=UTF-8");

    permitRequest('GET');
    checkRequest($_SERVER['REQUEST_METHOD']);

    // Recover target from the query string
    $minervaTarget = $_GET['target'] ?? '';
    $minervaTarget = htmlspecialchars($minervaTarget, ENT_QUOTES, 'UTF-8');
    checkString($minervaTarget);

    $minervaTarget = rtrim($minervaTarget, '/');
    $response = minerva_service_heartbeats($minervaTarget);
    echo json_encode($response);