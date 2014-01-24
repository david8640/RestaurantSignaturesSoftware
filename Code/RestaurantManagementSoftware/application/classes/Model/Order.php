<?php

/* 
 * <copyright file="Order.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>Andrew Assaly</author>
 * <date>2014-01-19</date>
 * <summary>Model representing a product that has been ordered and has a PO.</summary>
 */
class Model_Order extends Model {
    // Private members
    private $idOrder;
    private $idSupplier;
    private $idProduct;
    private $poNumber;
    private $quantity;
    private $cost;
    private $dateOrdered;
    private $dateDelivered;

     
    /**
     * Constructor of a Order model
     * @param int $idOrder the id of the order
     * @param int $idSupplier the id of the supplier the product is being ordered from
     * @param int $idProduct the id of the product in this order
     * @param int $poNumber the PO# of the order
     * @param string $quantity the name of the product in the order
     * @param string $dateOrdered the date ordered
     * @param string $dateDelivered the date delivered
     */
    public function __construct($idOrder, $idSupplier, $idProduct, $poNumber, $quantity, $cost, $dateOrdered, $dateDelivered) {
        $this->setOrderID($idOrder);
        $this->setSupplierID($idSupplier);
        $this->setProductID($idProduct);
        $this->setPONumber($poNumber);
        $this->setQuantity($quantity);
        $this->setPONumber($cost);
        $this->setDateOrdered($dateOrdered);
        $this->setDateDelivered($dateDelivered);
    }
   
    // Getters and setters
    /**
     * get the id of the order
     * @param int $idOrder 
     */
    public function getOrderID($idOrder) {
        return $this->idOrder;
    }

    /**
     * Set the id of the order
     * @param int $idOrder 
     */
    public function setOrderID($idOrder) {
        $this->idOrder = $idOrder;
    }

    /**
     * get the id of the supplier
     * @param int $idSupplier 
     */
    public function getSupplierID($idSupplier) {
        return $this->idSupplier;
    }
    
    /**
     * Set the id of the supplier
     * @param int $idSupplier 
     */
    public function setSupplierID($idSupplier) {
        $this->idSupplier = $idSupplier;
    }

    /**
     * get the id of the product
     * @param int $idProduct 
     */
    public function getProductID($idProduct) {
        return $this->idProduct;
    }
    
    /**
     * Set the id of the product
     * @param int $idProduct 
     */
    public function setProductID($idProduct) {
        $this->idProduct = $idProduct;
    }

    /**
     * get the PO of the product
     * @param int $poNumber 
     */
    public function getPONumber($poNumber) {
        return $this->poNumber;
    }
    
    /**
     * Set the PO of the product
     * @param int $poNumber 
     */
    public function setPONumber($poNumber) {
        $this->poNumber = $poNumber;
    }

    /**
     * get the quantity of the product
     * @param int $quantity 
     */
    public function getQuantity($quantity) {
        return $this->quantity;
    }
    
    /**
     * Set the quantity of the product
     * @param int $quantity 
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    /**
     * get the cost of the product
     * @param int $cost 
     */
    public function getCost($cost) {
        return $this->cost;
    }
    
    /**
     * Set the quantity of the product
     * @param int $quantity 
     */
    public function setCost($cost) {
        $this->cost = $cost;
    }

    /**
     * get the date the product was ordered
     * @param int $dateOrdered 
     */
    public function getDateOrdered($dateOrdered) {
        return $this->dateOrdered;
    }
    
    /**
     * Set the date the product was ordered
     * @param int $dateOrdered 
     */
    public function setDateOrdered($dateOrdered) {
        $this->dateOrdered = $dateOrdered;
    }

    /**
     * get the date the product was deliveredd
     * @param int $dateDelivered 
     */
    public function getDateDelivered($dateDelivered) {
        return $this->dateDelivered;
    }
    
    /**
     * Set the date the product was delivered
     * @param int $dateDelivered 
     */
    public function setDateDelivered($dateDelivered) {
        $this->dateDelivered = $dateDelivered;
    }
}

?>