<?php
// Configuration settings for MaxPerry E-Commerce

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'maxperry');
define('DB_USER', 'root');
define('DB_PASS', 'mysql'); // Change this if you have a database password set

// SMTP Mail Configuration (Official GuzelHosting Settings)
define('SMTP_HOST', 'ssl://mail.maxperryabiye.com');
define('SMTP_PORT', 465);
define('SMTP_USER', 'maxperry@maxperryabiye.com');
define('SMTP_PASS', '4uMjYd62m0'); // Hashing/cPanel/Mail standard password

// Base URL (Change to match your local development environment)
define('BASE_URL', 'http://localhost:8000');

// App Secret or Salt
define('APP_SECRET', 'MaxPerry_Evening_Dress_Secret_Key_2026');

// Session Config & Hardening
if (session_status() == PHP_SESSION_NONE) {
    // Only send cookies over HTTP protocol, not accessible by JavaScript
    ini_set('session.cookie_httponly', 1);
    
    // Use SameSite Lax cookies to protect against CSRF
    ini_set('session.cookie_samesite', 'Lax');
    
    // Only send cookies over HTTPS if HTTPS is active
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] == 443);
    ini_set('session.cookie_secure', $isSecure ? 1 : 0);
    
    // Prevent Session ID from being passed in URLs
    ini_set('session.use_only_cookies', 1);
    
    session_start();
}

/**
 * CSRF Token Generator
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * CSRF Token Validator
 * Protects against timing attacks using hash_equals
 */
function validateCsrfToken($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Error Handling / Information Disclosure Protection
// In production, keep display_errors OFF to prevent path leaking and DB structure disclosures
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); // Log all errors internally for debugging without showing them to users
