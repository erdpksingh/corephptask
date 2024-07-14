<?php
class CustomerDTO {
    public $name;
    public $surname;
    public $balance;

    public function __construct($name, $surname, $balance) {
        $this->name = $name;
        $this->surname = $surname;
        $this->balance = $balance;
    }
}
