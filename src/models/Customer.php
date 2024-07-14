<?php
class Customer {
    public $id;
    public $name;
    public $surname;
    public $balance;

    public function __construct($id, $name, $surname, $balance) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->balance = $balance;
    }
}
