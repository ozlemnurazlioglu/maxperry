<?php

class Controller {
    // Render a view and pass data
    protected function render($view, $data = []) {
        // Extract variables to make them available in the view file
        extract($data);

        // Path to the requested view
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("View not found: " . $view);
        }

        // We can capture the main view output and inject it into a layout
        // For simplicity and ease, we can include standard layout header and footer inside views
        // Or we can load header/footer automatically if we want layout-based design
        
        // Let's implement layout management:
        // We'll require header, then the view, then footer.
        $headerPath = __DIR__ . '/../views/layout/header.php';
        $footerPath = __DIR__ . '/../views/layout/footer.php';

        if (file_exists($headerPath)) {
            require_once $headerPath;
        }

        require_once $viewPath;

        if (file_exists($footerPath)) {
            require_once $footerPath;
        }
    }

    // Helper for redirection
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }

    // Helper for JSON responses
    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
