<?php

/*
 *  <copyright file="Controller_Index.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The default controller that will handle and dispatch all the request</summary>
 */

class Controller_Login extends Controller_Template_Generic {

    public function action_login() {
        // Transfert the information to the view.
        $view = View::factory('login/login');

        $this->template->title = __('Login');
        $this->template->content = $view;
    }

    public function action_process_Login() {
        $username = $_POST['username'];
        $repo = new Repository_User();
        $user = $repo->getViaUsername($username);
        
        if (!(Valid::not_empty($user))) {
            Session::instance()->set('feedbackMessage', array('No Username found'));
            $this->redirect ('login/login');
        }
        
        // Transfer the information to the view.
        $view = View::factory('login/process_login')
                ->set('user', $user);

        $this->template->title = __('Processing Login');
        $this->template->content = $view;
    }
    
        public function action_Register() {
        $username = $_POST['username'];
        $repo = new Repository_User();
        $user = $repo->getViaUsername($username);
        
        if (!(Valid::not_empty($user))) {
            Session::instance()->set('feedbackMessage', array('No Username found'));
            $this->redirect ('login/login');
        }
        
        // Transfer the information to the view.
        $view = View::factory('login/process_login')
                ->set('user', $user);

        $this->template->title = __('Processing Login');
        $this->template->content = $view;
    }

}

?>
