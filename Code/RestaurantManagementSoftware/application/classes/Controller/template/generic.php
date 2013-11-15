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
        $current = $this->request->uri();
        if ($current != 'login/login' && $current != 'login/process_login') {
            if ((Valid::not_empty($cookie = Cookie::get('secure_login')))) {
                $repo = new Repository_User();
                if ($user = $repo->getBySessionID($cookie)) {
                    echo "Welcome Back " . $user[0]->getName() . '!<br/>';
                } else {
                    $this->redirect('login/login');
                }
            } else {
                echo $this->redirect('login/login');
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

            $this->template->styles = array_merge($this->template->styles, $styles);
            $this->template->scripts = array_merge($this->template->scripts, $scripts);
        }
        parent::after();
    }

}
