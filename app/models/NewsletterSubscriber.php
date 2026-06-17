<?php

class NewsletterSubscriber extends Model {
    
    // Subscribe an email
    public function subscribe($email) {
        $email = strtolower(trim($email));
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // First check if already subscribed to avoid duplicate entry errors
        if ($this->isSubscribed($email)) {
            return true; 
        }

        $stmt = $this->db->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
        return $stmt->execute(['email' => $email]);
    }

    // Check if email is already subscribed
    public function isSubscribed($email) {
        $stmt = $this->db->prepare("SELECT id FROM newsletter_subscribers WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => strtolower(trim($email))]);
        return (bool)$stmt->fetch();
    }

    // Unsubscribe/delete an email
    public function unsubscribe($email) {
        $stmt = $this->db->prepare("DELETE FROM newsletter_subscribers WHERE email = :email");
        return $stmt->execute(['email' => strtolower(trim($email))]);
    }

    // Get all subscribers
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM newsletter_subscribers ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get subscribers count
    public function getCount() {
        $stmt = $this->db->prepare("SELECT COUNT(id) as total FROM newsletter_subscribers");
        $stmt->execute();
        $row = $stmt->fetch();
        return (int)($row['total'] ?? 0);
    }
}
