<?php

/* 
 *  <copyright file="Controller_Index.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The default controller that will handle and dispatch all the request</summary>
 */
class Controller_Index extends Controller_Template_Generic {
    public function action_index() { 
        $view = View::factory('index');
        
        $this->template->title = __('Index');
        $this->template->content = $view;
    }
}

?>
