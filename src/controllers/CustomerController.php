<?php
require_once 'src/services/CustomerService.php';

class CustomerController {
    private $service;

    public function __construct() {
        $this->service = new CustomerService();
    }

    public function create($data) {
        $customerDTO = new CustomerDTO($data['name'], $data['surname'], $data['balance']);
        if($this->service->addCustomer($customerDTO)) {
            return ['status' => 201, 'message' => 'Customer created successfully'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server Error'];
        }
    }

    public function read($id) {
        return $this->service->getCustomer($id);
    }

    public function update($id, $data) {
        $customerDTO = new CustomerDTO($data['name'], $data['surname'], $data['balance']);
        if($this->service->updateCustomer($id, $customerDTO)) {
            return ['status' => 200, 'message' => 'Customer updated successfully'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server Error'];
        }
    }

    public function delete($id) {
        if($this->service->deleteCustomer($id)) {
            return ['status' => 200, 'message' => 'Customer deleted successfully'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server Error'];
        }
    }
}
