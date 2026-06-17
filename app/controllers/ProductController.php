<?php

class ProductController extends Controller {
    
    // View all products
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();

        // Capture GET parameters for advanced search
        $filters = [
            'keyword' => $_GET['keyword'] ?? null,
            'category_id' => $_GET['category_id'] ?? null,
            'sku' => $_GET['sku'] ?? null,
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
            'sort' => $_GET['sort'] ?? 'default'
        ];

        // Check if any search filter is active
        $hasFilters = !empty($filters['keyword']) || !empty($filters['category_id']) || !empty($filters['sku']) || !empty($filters['min_price']) || !empty($filters['max_price']) || ($filters['sort'] !== 'default');

        if ($hasFilters) {
            $products = $productModel->search($filters);
        } else {
            $products = $productModel->getAll();
        }

        $categories = $categoryModel->getAll();

        $this->render('products/index', [
            'pageTitle' => $hasFilters ? 'Arama Sonuçları' : 'Tüm Koleksiyonlar',
            'products' => $products,
            'categories' => $categories,
            'activeCategory' => !empty($filters['category_id']) ? $categoryModel->getById($filters['category_id']) : null,
            'filters' => $filters
        ]);
    }

    // View products in a specific category
    public function category($slug) {
        $productModel = new Product();
        $categoryModel = new Category();

        $category = $categoryModel->getBySlug($slug);
        if (!$category) {
            http_response_code(404);
            die("Kategori bulunamadı.");
        }

        // To support sorting & filtering within a specific category cleanly
        $filters = [
            'category_id' => $category['id'],
            'sort' => $_GET['sort'] ?? 'default'
        ];

        $products = $productModel->search($filters);
        $categories = $categoryModel->getAll();

        $this->render('products/index', [
            'pageTitle' => $category['name'],
            'products' => $products,
            'categories' => $categories,
            'activeCategory' => $category,
            'filters' => $filters
        ]);
    }

    // View specific product details
    public function show($slug) {
        $productModel = new Product();
        $product = $productModel->getBySlug($slug);

        if (!$product) {
            // Not Found, Router handles showing 404
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            exit;
        }

        $this->render('products/show', [
            'pageTitle' => $product['name'],
            'product' => $product
        ]);
    }
}
