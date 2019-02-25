<?php

interface withID {
    public function getId(): int;
}

abstract class Manager {
    protected $pdo;
    protected $tableName;

    public function __construct($connect){
        $this->pdo = $connect;
    }

    protected function delete(withID $obj){
        echo "DELETE FROM ".$this->getTableName()." WHERE id=".$obj->getId()."\n";
    } 

    protected abstract function getTableName(): string;
}

class Product implements withID {
    public function getId(): int{
        return 1;
    }
}
class ProductManager extends Manager {
    public function deleteProduct(Product $obj){
        // $this->tableName = "product";
        parent::delete($obj);
    }

    protected function getTableName(): string{
        return "product";
    }
}

class Address implements withID {
    public function getId(): int{
        return 2;
    }
}
class AddressManager extends Manager {
    // public function delete(Address $obj){
    //     // $this->tableName = "product";
    //     parent::delete($obj);
    // }

    protected function getTableName(): string{
        return "address";
    }
}


$pm = new ProductManager("connect");
$am = new AddressManager("connect");

$p = new Product();
$a = new Address();

$pm->deleteProduct($p);
$am->delete($a);

