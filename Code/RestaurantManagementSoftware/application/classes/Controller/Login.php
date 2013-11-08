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

    public function action_process_login() {
        $username = $_POST['username'];
        $repo = new Repository_User();
        $user = $repo->getViaUsername($username);

        if (!(Valid::not_empty($user))) {
            Session::instance()->set('feedbackMessage', array('Incorrect username or password (really it\'s an incorrect username ☺)'));
            $this->redirect('login/login');
        }

        // Transfer the information to the view.
        $view = View::factory('login/process_login')
                ->set('user', $user);

        $this->template->title = __('Processing Login');
        $this->template->content = $view;
    }

    public function action_register() {
        $view = View::factory('login/register');

        $this->template->title = __('Register');
        $this->template->content = $view;
    }

    public function action_process_registration() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $secure_password = hash('sha512', $post['password'] . $post['salt']);
            $user = new Model_User(-1, $post['username'], $post['name'], $post['email'], $secure_password, $post['salt']);
            //$user = new Model_User(5, 'test', 'test', 'test@test.com', '6e6591627c7da94b0b3f31ff57589f82ec535352e0b66db038aa055495eb11edc7649560692b82267dda6eca1977a2f2336266550e9f9b55cfa5cf2e8f37972e', '1059368288c58a44f974d25c81cbf6cf607e15087f8aa0339ad13b635906259b5a31d5f4dd9896a91dd2545d62506a8f9494731dbdf29f803aba345a1b7496ba');
            if ($post->check()) {
                // Add the supplier

                $repo = new Repository_User();
                $success = $repo->add($user);

                // Redirect if the add was successful
                if ($success) {
                    echo 'test';
                    Session::instance()->set('feedbackMessage', array('New user created!'));
                    $this->redirect('login');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('register');
            }

            $view = View::factory('login/register')
                    ->set('user', $user)
                    ->set('submitAction', 'login/register');
            $this->template->title = __('Register a new user');
            //$this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect('login/register');
        }
    }

    public function action_logout() {
        $_SESSION = array();
// get session parameters 
        $params = session_get_cookie_params();
// Delete the actual cookie.
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// Destroy session
        session_destroy();
        $this->redirect('login/login');
    }

    private function getValidationFactory($post) {
        return Validation::factory($post)
                        ->rule('username', 'not_empty')
                        ->rule('username', 'max_length', array(':value', 30))
                        ->rule('name', 'not_empty')
                        ->rule('name', 'max_length', array(':value', 75))
                        ->rule('email', 'not_empty')
                        //email regex not working...
                        //->rule('email', 'regex', array(':value', '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])↪*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/'))
                        ->rule('password', 'not_empty')
                        ->rule('salt', 'not_empty');
    }

}

?>
