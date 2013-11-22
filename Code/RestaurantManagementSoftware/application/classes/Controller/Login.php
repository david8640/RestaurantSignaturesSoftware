<?php

/*
 *  <copyright file="Controller_Index.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The default controller that will handle and dispatch all the request</summary>
 */

//class Controller_Login extends Controller_Template_Generic {
class Controller_Login extends Controller_Template_Generic {
    public function action_login() {
        // Transfert the information to the view.
        $view = View::factory('login/login');

        $this->template->title = __('Login');
        $this->template->content = $view;
    }

    public function action_process_login() {
        if (isset($_POST['username'], $_POST['password'], $_POST['ipaddress'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $ipaddress = $_POST['ipaddress'];
            $repo = new Repository_User();
            $user = $repo->getViaUsername($username);
            if (!(Valid::not_empty($user))) {  //check if a user with the same username was found.
                Session::instance()->set('feedbackMessage', array('Incorrect username ☺ '));
                $this->redirect('login/login');
            } else {
                $salt = $user[0]->getSalt();
                $hashedPassword = hash('sha512', $password . $salt);
                if ($hashedPassword == $user[0]->getPassword()) { //successfully authenticated
                    $session_value = hash('sha512', $salt . $username . $ipaddress . $salt);
                    //$user[0]->setSessionId($session_value);
                    $user[0]->setSessionId($session_value);
                    $user[0]->setSessionExpiryTime(time() + 3600); //1hr
                    Cookie::set('secure_login', $session_value, $user[0]->getSessionExpiryTime());
                    session_start();
                    if ($repo->setSessionVars($user[0])) {
                        //saving session cookie hash to database success!
                        unset($password);
                        unset($salt);
                        unset($user_id);
                        unset($user_browser);
                        $this->redirect('index/index');
                    } else {
                        Session::instance()->set('feedbackMessage', array('Error saving session to Database'));
                    }
                } else {
                    // Login failed
                    unset($password);
                    unset($salt);
                    Session::instance()->set('feedbackMessage', array('Incorrect password ☺)'));
                    $this->redirect('login/login');
                }
            } //defualt
            // The correct POST variables were not sent to this page.
            echo 'Invalid POST';
        }
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
            $user = new Model_User(-1, $post['username'], $post['name'], $post['email'], $secure_password, $post['salt'], $post['sessionID'], $post['sessionExpiryTime']);
            if ($post->check()) {
                // Add a user
                $repo = new Repository_User();
                $success = $repo->add($user);

                // Redirect if the add was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('New user created!'));
                    $this->redirect('login/login');
                } else {
                    $feedbackMessage = array('');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('register');
            }

            $view = View::factory('login/register')
                    ->set('user', $user)
                    ->set('submitAction', 'login/process_registration');
            $this->template->title = __('Register a new user');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occurred.'));
            $this->redirect('login/register');
        }
    }

    public function action_logout() {
        // $_SESSION = array();
        // get session parameters 
        //$params = session_get_cookie_params();
        // Delete the actual cookie.
        //setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        // Destroy session
        //session_destroy();
        //session_write_close(); //(i think this is the right function to call to end the session).
        Cookie::delete('secure_login');
        Session::instance()->set('global_username', '');
        $this->redirect('login/login');
    }

    private function getValidationFactory($post) {
        return Validation::factory($post)
                        ->rule('username', 'not_empty')
                        ->rule('username', 'max_length', array(':value', 30))
                        ->label('username', 'Username')
                        ->rule('name', 'not_empty')
                        ->rule('name', 'max_length', array(':value', 75))
                        ->label('name', 'Name')
                        ->rule('email', 'not_empty')
                        ->rule('email', 'regex', array(':value', Constants::EmailRegex))
                        ->label('email', 'Email adress')
                        ->rule('password', 'not_empty')
                        ->label('password', 'Password')
                        ->rule('salt', 'not_empty')
                        ->label('salt', 'Salt');
    }

}

?>