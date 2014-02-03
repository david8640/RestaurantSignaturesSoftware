<?php

/* 
 *  <copyright file="OrderState.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>This class contains all the possible values for an order state.</summary>
 */
abstract class Constants_OrderState {
    private function __construct() {}
    
    const IN_PROGRESS = 0;
    const SUBMITTED = 1;
}