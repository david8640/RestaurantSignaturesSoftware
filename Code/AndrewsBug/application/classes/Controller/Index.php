<?php

/* 
 *  <copyright file="Controller_Index.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The default controller that will handle and dispatch all the request</summary>
 */
class Controller_Index extends Controller {
    public function action_index() {
        $loginView = Request::factory('login/findAll')->execute();
        $this->response->body($loginView);
    }
}

?>
