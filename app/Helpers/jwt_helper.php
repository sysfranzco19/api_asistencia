<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function create_jwt($data) {
    $key = getenv('JWT_SECRET');
    $payload = [
        'iat' => time(),
        'exp' => time() + 3600, // 1 hora
        'data' => $data
    ];
    return JWT::encode($payload, $key, 'HS256');
}

function validate_jwt($token) {
    try {
        $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
        return (array)$decoded->data;
    } catch (Exception $e) {
        return null;
    }
}
