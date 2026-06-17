<?php
// MaxPerry E-Commerce Application Entry Point

// 1. Load Configurations
require_once __DIR__ . '/app/config/config.php';

// 2. Custom Autoloader for MVC Classes
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/app/core/',
        __DIR__ . '/app/models/',
        __DIR__ . '/app/controllers/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// 3. Initialize Router
$router = new Router();

// --- Define Routes ---

// Front Store Routes
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/products', 'ProductController@index');
$router->add('GET', '/category/{slug}', 'ProductController@category');
$router->add('GET', '/product/{slug}', 'ProductController@show');
$router->add('GET', '/contact', 'HomeController@contact');
$router->add('GET', '/about', 'HomeController@about');
$router->add('POST', '/contact/submit', 'HomeController@submitContact');
$router->add('POST', '/newsletter/subscribe', 'HomeController@subscribeNewsletter');

// Auth & User Routes
$router->add('GET', '/login', 'AuthController@loginPage');
$router->add('POST', '/login/submit', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@registerPage');
$router->add('POST', '/register/submit', 'AuthController@register');
$router->add('GET', '/forgot-password', 'AuthController@forgotPasswordPage');
$router->add('POST', '/forgot-password/submit', 'AuthController@forgotPasswordSubmit');
$router->add('GET', '/reset-password/{token}', 'AuthController@resetPasswordPage');
$router->add('POST', '/reset-password/submit', 'AuthController@resetPasswordSubmit');
$router->add('GET', '/logout', 'AuthController@logout');
$router->add('GET', '/profile', 'AuthController@profile');

// Admin Panel Routes
$router->add('GET', '/admin', 'AdminController@index');
$router->add('GET', '/admin/products', 'AdminController@products');
$router->add('GET', '/admin/product/add', 'AdminController@addProductPage');
$router->add('POST', '/admin/product/add/submit', 'AdminController@addProduct');
$router->add('GET', '/admin/product/edit/{id}', 'AdminController@editProductPage');
$router->add('POST', '/admin/product/edit/{id}/submit', 'AdminController@editProduct');
$router->add('GET', '/admin/product/delete/{id}', 'AdminController@deleteProduct');

// Admin Category Routes
$router->add('GET', '/admin/categories', 'AdminController@categories');
$router->add('GET', '/admin/category/add', 'AdminController@addCategoryPage');
$router->add('POST', '/admin/category/add/submit', 'AdminController@addCategory');
$router->add('GET', '/admin/category/edit/{id}', 'AdminController@editCategoryPage');
$router->add('POST', '/admin/category/edit/{id}/submit', 'AdminController@editCategory');
$router->add('GET', '/admin/category/delete/{id}', 'AdminController@deleteCategory');

// Admin User Management Routes
$router->add('GET', '/admin/users', 'AdminController@users');

// Admin Message Routes
$router->add('GET', '/admin/messages', 'AdminController@messages');
$router->add('GET', '/admin/messages/delete/{id}', 'AdminController@deleteMessage');

// 4. Dispatch Route
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Dispatch using base subdirectory if hosted inside a folder, else normal
// E.g., if hosted at http://localhost/maxperry/, strip "/maxperry" from Request URI
// For easy "php -S localhost:8000" run, BASE_URL is "http://localhost:8000", URI matches directly.
$router->dispatch($requestUri, $requestMethod);
