<?php
require_once 'src/repositories/CustomerRepository.php';

class CustomerService {
    private $repository;

    public function __construct() {
        $this->repository = new CustomerRepository();
    }

    public function addCustomer($customerDTO) {
        return $this->repository->createCustomer($customerDTO);
    }

    public function getCustomer($id) {
        $customerData = $this->repository->getCustomer($id);
        if ($customerData) {
            return new Customer($customerData['id'], $customerData['name'], $customerData['surname'], $customerData['balance']);
        }
        return null;  // or throw an exception if you prefer
    }

    public function updateCustomer($id, $customerDTO) {
        // Ensure the balance is not negative before updating
        if ($customerDTO->balance < 0) {
            throw new Exception("Balance cannot be negative.");
        }
        return $this->repository->updateCustomer($id, $customerDTO);
    }

    public function deleteCustomer($id) {
        return $this->repository->deleteCustomer($id);
    }
}
