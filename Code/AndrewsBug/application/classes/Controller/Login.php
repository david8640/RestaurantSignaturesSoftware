<?php

/* 
 *  <copyright file="Controller_Supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The controller that handle all the manipulation on suppliers.</summary>
 */
class Controller_Login extends Controller {
    
    public function action_findAll() {
        $repo = new Repository_User();
        $login = $repo->getAll();
        
        $view = View::factory('login')
                    ->set('login',$login);
        
        $this->response->body($view);
    }
}

?>