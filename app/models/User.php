<?php

class User extends Model {
    
    // Create a new user
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password, role) 
            VALUES (:name, :email, :password, :role)
        ");
        
        // Hash the password for security
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'role' => $data['role'] ?? 'customer'
        ]);
    }

    // Find user by email (for Login)
    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    // Find user by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Update user profile details
    public function updateProfile($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, phone = :phone, address = :address";
        $params = [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null
        ];

        if (!empty($data['password'])) {
            $sql .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Get all registered users (Admin Panel)
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT id, name, email, role, created_at 
            FROM users 
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Update password by email address
    public function updatePasswordByEmail($email, $password) {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
}
