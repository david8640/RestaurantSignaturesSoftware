<?php

/*
 *  <copyright file="ValidationExtension.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>The validation class that add some validation functions to the basic class of Kohana.</summary>
 */
class ValidationExtension {
    public static function positive_number($value) {
        return ($value >= 0);
    }
}
