<?php

class Product {
    private $id;
    private $name;
    private $price;

    public function hydrate(array $datas) {
        foreach ($datas as $key => $value) {
            $methodName = "set" . ucfirst($key);
            echo $methodName."</br>";
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }


    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getName(){
        return $this->name;
    }

    function setName($name){
        $this->name = $name;
    }

    function getPrice(){
        return $this->price;
    }

    function setPrice($price){
        $this->price = $price;
    }
}