<?php

declare(strict_types=1);

/**
 * Base URL for the Rust backend API.
 * Ensure the version prefix matches the running backend instance.
 */
const API_BASE_URL = 'http://127.0.0.1:3002/api/v0500bc2-dev';

/**
 * Send an HTTP request to the backend API.
 *
 * This function acts as a Backend-for-Frontend (BFF) bridge, handling the
 * cURL implementation and JSON encoding/decoding.
 *
 * @param string               $method   HTTP verb (GET, POST, PUT, PATCH, DELETE).
 * @param string               $endpoint The API endpoint path (e.g., '/auth/login').
 * @param array<string, mixed> $data     The payload to send. Ignored for GET/DELETE.
 * @param string|null          $token    Optional JWT Bearer token for authentication.
 *
 * @return array{status: int, body: array<string, mixed>} The HTTP status code and decoded JSON response.
 */
function api_request(string $method, string $endpoint, array $data = [], ?string $token = null): array
{
    $url = API_BASE_URL . $endpoint;
    $ch = curl_init($url);

    if ($ch === false) {
        return [
            'status' => 500,
            'body' => ['error' => ['message' => 'Failed to initialize cURL.']],
        ];
    }

    $headers = ['Content-Type: application/json'];

    if ($token !== null && $token !== '') {
        $headers[] = 'Authorization: Bearer ' . $token;
    }

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    if (!empty($data) && in_array($method, ['POST', 'PUT', 'PATCH'], true)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        return [
            'status' => 500,
            'body' => ['error' => ['message' => 'Backend connection failed: ' . $curlError]],
        ];
    }

    $decoded = json_decode((string) $response, true);

    if ($decoded === null) {
        $decoded = ['error' => ['message' => 'Invalid JSON response from backend.']];
    }

    return [
        'status' => $httpCode,
        'body' => $decoded,
    ];
}
