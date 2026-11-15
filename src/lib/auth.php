<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Store authentication data in the PHP session.
 *
 * This function stores the JWT token and the user's profile data.
 * It should only be called after a successful login or registration.
 *
 * @param string               $token The JWT token returned by the backend.
 * @param array<string, mixed> $user  The user object returned by the backend.
 *
 * @return void
 */
function set_auth_session(string $token, array $user): void
{
    $_SESSION['jwt_token'] = $token;
    $_SESSION['user'] = $user;
    $_SESSION['role'] = $user['role'] ?? 'customer';
}

/**
 * Check if the current user is authenticated.
 *
 * @return bool True if a JWT token exists in the session, false otherwise.
 */
function is_logged_in(): bool
{
    return isset($_SESSION['jwt_token']);
}

/**
 * Retrieve the authenticated user's data from the session.
 *
 * @return array<string, mixed>|null The user data, or null if not logged in.
 */
function current_user(): ?array
{
    $user = $_SESSION['user'] ?? null;

    return is_array($user) ? $user : null;
}

/**
 * Enforce authentication for protected routes.
 *
 * Redirects the user to the login page if they are not authenticated.
 *
 * @return void
 */
function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: /index.php?page=auth/login');
        exit;
    }
}
