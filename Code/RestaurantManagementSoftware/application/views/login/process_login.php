<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//function login($username, $password, $users) {
//   // Using prepared Statements means that SQL injection is not possible. 
//   if ($stmt = $users->prepare("SELECT id, email, password, salt FROM users WHERE username = ? LIMIT 1")) { 
//      $stmt->bind_param('s', $username); // Bind "$username" to parameter.
//      $stmt->execute(); // Execute the prepared query.
//      $stmt->store_result();
//      $stmt->bind_result($user_id, $email, $db_password, $salt); // get variables from result.
//      $stmt->fetch();
//      $password = hash('sha512', $password.$salt); // hash the password with the unique salt.
// 
//      if($stmt->num_rows == 1) { // If the user exists
//         // We check if the account is locked from too many login attempts
//         //if(checkbrute($user_id, $users) == true) { 
//            // Account is locked
//            // Send an email to user saying their account is locked
//          //  return false;
//         } else {
//         if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
//            // Password is correct!
// 
// 
//               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
// 
//               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
//               $_SESSION['user_id'] = $user_id; 
//               $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
//               $_SESSION['username'] = $username;
//               $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
//               // Login successful.
//               return true;    
//         } else {
//            // Password is not correct
//            // We record this attempt in the database
//            $now = time();
//            $ipaddress = get_client_ip();
//            $users->query("INSERT INTO `login_attempts` (id, timeOfAttempt, ip_address) VALUES ('$user_id', '$now', '$ipaddress'");
//            return false;
//         }
//      }
//      } else {
//         // No user exists. 
//         return false;
//      }
//   }
//if (isset($user)) {
//    foreach ($user as $u) {
//        echo 'username: ' . $u->getUsername();
//        echo 'salt: ' . $u->getSalt();
//    }
//}

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
