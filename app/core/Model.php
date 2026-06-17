<?php

class Model {
    protected $db;

    public function __construct() {
        // Get the active PDO connection
        $this->db = Database::getInstance()->getConnection();
    }
}
