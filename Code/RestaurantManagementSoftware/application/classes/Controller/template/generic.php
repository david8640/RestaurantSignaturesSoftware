<?php

/*
 *  <copyright file="generic.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The generic controller.</summary>
 */

class Controller_Template_Generic extends Controller_Template {

    public $template = 'template/generic';

    /**
     * The before() method is called before your controller action.
     * In our template controller we override this method so that we can
     * set up default values. These variables are then available to our
     * controllers if they need to be modified.
     */
    public function before() {
        parent::before();
        $this->template->hide_menu = true;
        
        $controller = strtolower($this->request->controller());
        if ($controller != 'login') {
            $this->template->hide_menu = false;

            if ((Valid::not_empty($cookie = Cookie::get('secure_login')))) {
                $repo = new Repository_User();
                $user = $repo->getBySessionID($cookie);
                if ($user != null) {
                    $this->template->global_username = $user[0]->getName();
                    $this->template->global_user_id = $user[0]->getId();
                    $this->template->global_selected_location = $user[0]->getLocation();
                } else {
                    //$this->redirect('login/login');
                }
            } else {
                //echo $this->redirect('login/login');
            }
        }

        if ($this->auto_render) {
            // Initialize empty values
            $this->template->title = '';
            $this->template->content = '';

            $this->template->styles = array();
            $this->template->scripts = array();
        }
    }

    /**
     * The after() method is called after your controller action.
     * In our template controller we override this method so that we can
     * make any last minute modifications to the template before anything
     * is rendered.
     */
    public function after() {
        if ($this->auto_render) {
            $styles = array();

            $scripts = array();

            $controller = strtolower($this->request->controller());
            $action = strtolower($this->request->action());
            if ($controller == 'login' && $action == 'login') {
                $sessionFeedbackmessage = Session::instance()->get_once('feedbackMessage');                
                if (isset($this->template->feedbackMessage)) {
                    $this->template->loginFeedbackMessage = $this->template->feedbackMessage;
                    $this->template->feedbackMessage = array();
                    
                } else if (isset($sessionFeedbackmessage)) {
                    Session::instance()->set('loginFeedbackMessage', $sessionFeedbackmessage);
                }
            }
            
            if (isset($this->template->global_user_id)) {
                // Set the locations variable
                $repo = new Repository_Restaurant();
                $this->template->locations = $repo->getUserLocations($this->template->global_user_id);
            }
            
            $this->template->styles = array_merge($this->template->styles, $styles);
            $this->template->scripts = array_merge($this->template->scripts, $scripts);
        }
        parent::after();
    }

}
