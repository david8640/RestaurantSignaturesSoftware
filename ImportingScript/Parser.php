<?php

require_once 'lib/excel/php-excel-reader/excel_reader2.php';
require_once 'lib/excel/SpreadsheetReader.php';
require_once 'Supplier.php';
require_once 'Category.php';
require_once 'Product.php';
require_once 'SupplierProduct.php';

const FILE_NAME = "Ingredients.xlsx";
const SUPPLIER_FIRST_ID = 6;
const CATEGORY_FIRST_ID = 5;
const PRODUCT_FIRST_ID = 5;
const CAT_DELIMITER = " - ";

class Parser {
    private $suppliers = array();
    private $categories = array();
    private $products = array();
    private $suppliersProducts = array();
    private $nextSupplierId = SUPPLIER_FIRST_ID;
    private $nextCatId = CATEGORY_FIRST_ID;
    private $nextProdId = PRODUCT_FIRST_ID;
    
    public function parse() {
        $reader = new SpreadsheetReader(FILE_NAME, 0);

        $i = 0;

        foreach ($reader as $row)
        {
            if ($i != 0) {
                $this->addNewSupplier($row);
                $this->addNewCategory($row);
                $this->addNewProduct($row);
            }
            $i++;
        }
        
        $this->createSuppliersProducts();
    }
    
    public function getSuppliers() {
        return $this->suppliers;
    }
    
    public function getCategories() {
        return $this->categories;
    }
    
    public function getProducts() {
        return $this->products;
    }
    
    public function getSuppliersProducts() {
        return $this->suppliersProducts;
    }
    
    private function addNewSupplier($row) {
        $supplierName = $row[2];

        if (!$this->supplierExists($supplierName)) {
            array_push($this->suppliers, new Supplier($this->nextSupplierId++, $supplierName));
        }
    }
    
    private function supplierExists($supplierName) {
        foreach ($this->suppliers as $s) {
            if ($s->getName() == $supplierName) {
                return true;
            }
        }
        return false;
    }
    
    private function addNewCategory($row) {
        $categoriesNames = explode(CAT_DELIMITER, $row[1]);

        $fullName = "";
        for ($i = 0; $i < count($categoriesNames); $i++) {
            $fullName .= (($i != 0) ? CAT_DELIMITER: "").$categoriesNames[$i];
            if (!$this->categoryExists($fullName)) {
                if ($i - 1 >= 0) {
                    $parent = $this->getCategoryId($categoriesNames[$i - 1]);
                } else {
                    $parent = -1;
                }
                
                array_push($this->categories, new Category($this->nextCatId++, $categoriesNames[$i], $parent, $fullName));
            }
        }
    }
    
    private function categoryExists($catFullName) {
        foreach ($this->categories as $c) {
            if ($c->getFullName() == $catFullName) {
                return true;
            }
        }
        return false;
    }
    
    private function addNewProduct($row) {
        $productName = str_replace('"', '\"', $row[0]);
        
        $productCat = $row[1];
        $productCatId = $this->getCategoryId($row[1]);
        
        $productSupplierName = $row[2];
        $productSupplierId = $this->getSupplierId($productSupplierName);
        
        $productUnit = $row[3];
        
        array_push($this->products, new Product($this->nextProdId++, $productName, 
                $productCatId, $productCat, $productUnit, $productSupplierId, 
                $productSupplierName));
    }
    
    private function getCategoryId($catFullName) {
        foreach ($this->categories as $c) {
            if ($c->getFullName() == $catFullName) {
                return $c->getId();
            }
        }
        
        //throw new Exception("Invalid Category Name");
    }
    
    private function getSupplierId($supplierName) {
        foreach ($this->suppliers as $s) {
            if ($s->getName() == $supplierName) {
                return $s->getId();
            }
        }
        
        throw new Exception("Invalid Supplier Name");
    }
    
    private function createSuppliersProducts() {
        foreach ($this->products as $p) {
            array_push($this->suppliersProducts, new SupplierProduct($p->getId(), $p->getSupplierId(), $p->getUnitOfMeasurement(), 0));
        }
    }
}