<?php

require_once 'Parser.php';
require_once 'DatabaseManager.php';

$parser = new Parser();
$parser->parse();

$db = new DatabaseManager();
$db->insertSupplier($parser->getSuppliers());
$db->insertCategories($parser->getCategories());
$db->insertProducts($parser->getProducts());
$db->insertSuppliersProducts($parser->getSuppliersProducts());
 
/*foreach ($parser->getSuppliers() as $s) {
    echo $s->getId().' '.$s->getName().'<br/>';
}

echo '<br /><br />';

foreach ($parser->getCategories() as $c) {
    echo $c->getId().' '.$c->getName().' '.$c->getParent().' '.$c->getFullName().'<br/>';
}

echo '<br /><br />';

foreach ($parser->getProducts() as $c) {
    echo $c->getId().' '.$c->getName().' '.$c->getCategoryId().' '.$c->getCategoryName().' '.$c->getSupplierId().' '.$c->getSupplierName().'<br/>';
}

echo '<br /><br />';

foreach ($parser->getSuppliersProducts() as $c) {
    echo $c->getProductID().' '.$c->getSupplierID().' '.$c->getUnitOfMeasurement().'<br/>';
}*/