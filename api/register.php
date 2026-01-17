<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed.']);
    exit;
}

$rawBody = file_get_contents('php://input');
$payload = json_decode($rawBody, true);

$name = $payload['name'] ?? '';
$email = $payload['email'] ?? '';
$password = $payload['password'] ?? '';

if (trim($name) === '' || trim($email) === '' || trim($password) === '') {
    http_response_code(400);
    echo json_encode(['message' => 'Name, email, and password are required.']);
    exit;
}

http_response_code(201);

$shortName = strtok($name, ' ');
$message = sprintf('Thanks %s! Your SmartVaults onboarding request has been received.', $shortName);

echo json_encode([
    'message' => $message
]);
