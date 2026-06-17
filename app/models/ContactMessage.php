<?php

class ContactMessage extends Model {
    
    // Save contact message
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO contact_messages (name, email, phone, message) 
            VALUES (:name, :email, :phone, :message)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message']
        ]);
    }

    // Get all contact messages for Admin
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT id, name, email, phone, message, created_at 
            FROM contact_messages 
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Delete a contact message
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM contact_messages WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
