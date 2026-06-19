<?php

class Product extends Model {
    
    // Get all products
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get latest products
    public function getLatest($limit = 4) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.id DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get products by Category ID
    public function getByCategory($categoryId) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.category_id = :category_id 
            ORDER BY p.id DESC
        ");
        $stmt->execute(['category_id' => $categoryId]);
        return $stmt->fetchAll();
    }

    // Get single product by Slug
    public function getBySlug($slug) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.slug = :slug 
            LIMIT 1
        ");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }

    // Get single product by ID
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.id = :id 
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Create new product (Admin)
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO products (sku, category_id, name, slug, description, price, discount_price, stock, image_url, video_url) 
            VALUES (:sku, :category_id, :name, :slug, :description, :price, :discount_price, :stock, :image_url, :video_url)
        ");
        return $stmt->execute([
            'sku' => $data['sku'] ?? null,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'discount_price' => $data['discount_price'] ?? null,
            'stock' => $data['stock'],
            'image_url' => $data['image_url'],
            'video_url' => $data['video_url'] ?? null
        ]);
    }

    // Update product (Admin)
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE products SET 
                sku = :sku,
                category_id = :category_id,
                name = :name,
                slug = :slug,
                description = :description,
                price = :price,
                discount_price = :discount_price,
                stock = :stock,
                image_url = :image_url,
                video_url = :video_url
            WHERE id = :id
        ");
        return $stmt->execute([
            'sku' => $data['sku'] ?? null,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'discount_price' => $data['discount_price'] ?? null,
            'stock' => $data['stock'],
            'image_url' => $data['image_url'],
            'video_url' => $data['video_url'] ?? null,
            'id' => $id
        ]);
    }

    // Advanced Search & Filter (Inspired by AlfaBeta & premium fashion standards)
    public function search($filters) {
        $sql = "
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE 1=1
        ";
        $params = [];

        // 1. Keyword search (Name and Description)
        if (!empty($filters['keyword'])) {
            $sql .= " AND (p.name LIKE :keyword OR p.description LIKE :keyword)";
            $params['keyword'] = '%' . $filters['keyword'] . '%';
        }

        // 2. Category Filter
        if (!empty($filters['category_id'])) {
            $sql .= " AND p.category_id = :category_id";
            $params['category_id'] = (int)$filters['category_id'];
        }

        // 3. Stock Code (SKU) Search
        if (!empty($filters['sku'])) {
            $sql .= " AND p.sku LIKE :sku";
            $params['sku'] = '%' . $filters['sku'] . '%';
        }

        // 4. Min Price (checks active selling price: discount_price if available, otherwise regular price)
        if (!empty($filters['min_price'])) {
            $sql .= " AND COALESCE(p.discount_price, p.price) >= :min_price";
            $params['min_price'] = (float)$filters['min_price'];
        }

        // 5. Max Price (checks active selling price)
        if (!empty($filters['max_price'])) {
            $sql .= " AND COALESCE(p.discount_price, p.price) <= :max_price";
            $params['max_price'] = (float)$filters['max_price'];
        }

        // 6. Dynamic Sorting (Inspired by AlfaBeta & user request)
        $sort = $filters['sort'] ?? 'default';
        if ($sort === 'price_asc') {
            $sql .= " ORDER BY COALESCE(p.discount_price, p.price) ASC";
        } elseif ($sort === 'price_desc') {
            $sql .= " ORDER BY COALESCE(p.discount_price, p.price) DESC";
        } elseif ($sort === 'discount') {
            // Sort by highest discount percentage/amount
            $sql .= " ORDER BY (p.price - COALESCE(p.discount_price, p.price)) DESC";
        } elseif ($sort === 'newest') {
            $sql .= " ORDER BY p.id DESC";
        } else {
            // Recommended / default sorting
            $sql .= " ORDER BY p.id DESC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Delete product (Admin)
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Update product stock after purchase or admin action
    public function updateStock($productId, $newStock) {
        $stmt = $this->db->prepare("UPDATE products SET stock = :stock WHERE id = :id");
        return $stmt->execute([
            'stock' => $newStock,
            'id' => $productId
        ]);
    }
}
