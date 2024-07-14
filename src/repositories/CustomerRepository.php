<?php
require_once 'config/database.php';

class CustomerRepository {
    private $conn;

    public function __construct() {
        $database = new Database(); // Create a new Database instance
        $this->conn = $database->getConnection(); // Establish the connection
    }

    public function createCustomer($customerDTO) {
        $query = "INSERT INTO customers (name, surname, balance) VALUES (:name, :surname, :balance)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $customerDTO->name);
        $stmt->bindParam(':surname', $customerDTO->surname);
        $stmt->bindParam(':balance', $customerDTO->balance);
        return $stmt->execute(); // Execute the prepared statement
    }

    public function getCustomer($id) {
        $query = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the customer data
    }

    public function updateCustomer($id, $customerDTO) {
        $query = "UPDATE customers SET name = :name, surname = :surname, balance = :balance WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $customerDTO->name);
        $stmt->bindParam(':surname', $customerDTO->surname);
        $stmt->bindParam(':balance', $customerDTO->balance);
        return $stmt->execute(); // Execute the update
    }

    public function deleteCustomer($id) {
        $query = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Execute the delete
    }
}
