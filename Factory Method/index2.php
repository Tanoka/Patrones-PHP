<?php
class ProductFactory
{
    public static function build($type) {
        // assumes the use of an autoloader
        $product = "Product_" . $type;
        if (class_exists($product)) {
            return new $product();
        }
        else {
            throw new Exception("Invalid product type given.");
        }
    }

}

// build a new Product_Computer type
$myComputer = ProductFactory::build("Computer");
// build a new Product_Tablet type
$myTablet = ProductFactory::build("Tablet");