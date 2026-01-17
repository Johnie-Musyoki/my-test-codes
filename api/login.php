<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed.']);
    exit;
}

$rawBody = file_get_contents('php://input');
$payload = json_decode($rawBody, true);

$email = $payload['email'] ?? '';
$password = $payload['password'] ?? '';

if (trim($email) === '' || trim($password) === '') {
    http_response_code(400);
    echo json_encode(['message' => 'Email and password are required.']);
    exit;
}

http_response_code(200);

echo json_encode([
    'message' => 'Login submitted. A vault specialist will verify your access shortly.'
]);
