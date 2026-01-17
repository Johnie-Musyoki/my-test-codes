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
$company = $payload['company'] ?? null;

if (trim($name) === '' || trim($email) === '') {
    http_response_code(400);
    echo json_encode(['message' => 'Name and email are required.']);
    exit;
}

http_response_code(201);
$message = sprintf('Thanks %s! Our team will reach out to %s within 24 hours.', $name, $email);

echo json_encode([
    'message' => $message,
    'company' => $company
]);
