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

    /**
     * Validate CSRF Token securely.
     * Aborts request with a user-friendly error message if token is invalid or missing.
     */
    protected function checkCsrf() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!validateCsrfToken($token)) {
                $_SESSION['error_message'] = "Güvenlik uyarısı: Geçersiz veya süresi dolmuş güvenlik (CSRF) anahtarı. Lütfen sayfayı yenileyip tekrar deneyin.";
                
                // For JSON/AJAX requests
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    $this->json(['status' => 'error', 'message' => 'Geçersiz güvenlik (CSRF) anahtarı.'], 403);
                }
                
                $referer = $_SERVER['HTTP_REFERER'] ?? '/';
                // Ensure referer is safe and starts with BASE_URL or is relative
                if (strpos($referer, BASE_URL) === 0) {
                    header("Location: " . $referer);
                } else {
                    $this->redirect('/');
                }
                exit;
            }
        }
    }

    // Helper for JSON responses
    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
