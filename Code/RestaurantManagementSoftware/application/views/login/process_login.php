<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user;
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $salt = $user[0]->getSalt();
    $hashedPassword = hash('sha512', $password . $salt); // The unhashed password.
    //echo $hashedPassword; //(manual way to see the hash this login function generates prior to being inserted to mysql
    if ($hashedPassword == $user[0]->getPassword()) {
        // Login success
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
        $user_id = $user[0]->getId();
        $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
        $_SESSION['user_id'] = $user_id;
        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
        $_SESSION['username'] = $username;
        $_SESSION['login_string'] = hash('sha512', $password . $user_browser);



        //if we could use cookies, then use this method for a session... it's more secure.
//        session_regenerate_id(); // regenerated the session, delete the old one. 
//        $session_name = 'sec_session_id'; // Set a custom session name
//        $secure = false; // Set to true if using https.
//        $httponly = true; // This stops javascript being able to access the session id. 
//        
//        
//        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
//        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
//        
//        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
//        session_name($session_name); // Sets the session name to the one set above.
//        session_start(); // Start the php session


        echo 'Success: You have been logged in!';
        unset($password);
        unset($salt);
        unset($user_id);
        unset($user_browser);
    } else {
        // Login failed
        echo 'Login Failed';
        unset($password);
        unset($salt);
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
?>
