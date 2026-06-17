<?php

class Category extends Model {
    
    // Get all categories
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get category by slug
    public function getBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }

    // Get category by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Create a category (Admin)
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO categories (name, slug, description) 
            VALUES (:name, :slug, :description)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null
        ]);
    }

    // Update a category (Admin)
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE categories SET 
                name = :name,
                slug = :slug,
                description = :description
            WHERE id = :id
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'id' => $id
        ]);
    }

    // Delete a category (Admin)
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
