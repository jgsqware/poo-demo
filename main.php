<?php

class Main{
    public static function start(){

        $pdo = new Pdo("mysql:host=mysql:3306;dbname=pdo","user","pwd");

        $product1 = self::getOneProductByNameAsMap($pdo,"Table");
        self::printProductMap($product1);

        $product2 = self::getOneProductByNameAsObjectHydrate($pdo,"Table");
        self::printProduct($product2,"with Hydrate method");

        $product3 = self::getOneProductByNameWithFetchClass($pdo,"Table");
        self::printProduct($product3,"with PDO statement. PDO::FETCH_CLASS mode");

//        $product4 = self::getOneProductByNameWithFetchInto($pdo,"Table");
//        self::printProduct($product4,"with PDO statement. PDO::FETCH_INTO mode");

        $products = self::getProductsWithFetchClass($pdo);

        foreach ($products as $product) {
            self::printProduct($product,"with PDO statement. PDO::FETCH_CLASS mode");

        }
    }

    public static function printProductMap($product) {
        echo "<h1>Product Map</h1>";
        echo "</br>";
        echo "<p>Name: ".$product["name"]."</p>";
        echo "</br>";
        echo "</br>";

    }

    public static function printProduct(Product $product,$text) {
        echo "<h1>Product Object: ".$text."</h1>";
        echo "</br>";
        echo "<p>Name: ".$product->getName()."</p>";
        echo "</br>";
        echo "</br>";

    }

    public static function getOneProductByNameAsMap(PDO $pdo, $name){
        $stmt = $pdo->query("SELECT * FROM product WHERE name='".$name."'");

        return $stmt->fetch();
    }

    public static function getOneProductByNameAsObjectHydrate($pdo,$name){
        $stmt = $pdo->query("SELECT * FROM product WHERE name='".$name."'");
        $datas = $stmt->fetch();
        $product = new Product();
        $product->hydrate($datas);

        return $product;
    }

    public static function getOneProductByNameWithFetchClass(PDO $pdo,$name){
        $stmt = $pdo->query("SELECT * FROM product WHERE name='".$name."'");


        $stmt->setFetchMode(PDO::FETCH_CLASS,"Product");
        return $stmt->fetch();
    }

    public static function getOneProductByNameWithFetchInto(PDO $pdo,$name){
        $stmt = $pdo->prepare("SELECT * FROM product WHERE name='".$name."'");

        $product = new Product();
        $stmt->setFetchMode(PDO::FETCH_INTO,$product);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getProductsWithFetchClass(PDO $pdo){
        $stmt = $pdo->query("SELECT * FROM product");


        $stmt->setFetchMode(PDO::FETCH_CLASS,"Product");

        $products = array();

        while($p = $stmt->fetch()){
            $products[] = $p;
        }

        return $products;
    }
}