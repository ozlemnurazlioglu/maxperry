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

// Session Config
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
