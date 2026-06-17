<?php

class PasswordReset extends Model {
    
    // Store safe token for password reset
    public function createToken($email, $token) {
        // Clear any old tokens first
        $this->deleteByEmail($email);
        
        $stmt = $this->db->prepare("
            INSERT INTO password_resets (email, token) 
            VALUES (:email, :token)
        ");
        return $stmt->execute([
            'email' => $email,
            'token' => $token
        ]);
    }

    // Retrieve record by token
    public function getByToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM password_resets WHERE token = :token LIMIT 1");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch();
    }

    // Delete token record by email
    public function deleteByEmail($email) {
        $stmt = $this->db->prepare("DELETE FROM password_resets WHERE email = :email");
        return $stmt->execute(['email' => $email]);
    }
}
