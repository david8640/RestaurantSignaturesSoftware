<?php

/* 
 *  <copyright file="PurchaseOrderState.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>This class contains all the possible values for an purchase order state.</summary>
 */
abstract class Constants_PurchaseOrderState {
    private function __construct() {}
    
    const IN_PROGRESS = 0;
    const ORDERED = 1;
    const SHIPPED = 2;
    const RECEIVED = 3;
}
