<?php

/* 
 *  <copyright file="Controller_RestaurantUser.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The controller that handle all the manipulation on restaurants users.</summary>
 */
class Controller_RestaurantUser extends Controller_Template_Generic {
    /**
     * Get all the restaurants users.
     */
    public function action_findAll() {
        // Get all the informations from the repositories.
        $repo = new Repository_RestaurantUser();
        $restaurantantsUsers = $repo->getAll();
        
        $repoUser = new Repository_User();
        $users = $repoUser->getAll();
        
        $repoRestaurants = new Repository_Restaurant();
        $restaurants = $repoRestaurants->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('restaurant/restaurants_users')
                    ->set('usersRights', $this->getUserRights($restaurantantsUsers))
                    ->set('users', $users)
                    ->set('restaurants', $restaurants);
        
        $this->template->title = __('User Access Management');
        $this->template->content = $view;
    }
    
    /**
     * Save the user access to a restaurant.
     */
    public function action_save() {
        if (isset($_POST)) {
            $restaurantsUsers = $this->getCheckUsers($_POST);
                     
            // Subscribe or Unsubcribe user to give them access to the restaurant
            $repo = new Repository_RestaurantUser();
            $success = $repo->subscribeOrUnsubcribeUsersToRestaurants($restaurantsUsers);

            // Set the message
            $message = '';
            if ($success) {
                $message = 'The user access were updated.';
            } else {
                $message = 'An error occured.';
            }
            Session::instance()->set('feedbackMessage', array($message));
            $this->redirect ('restaurantUser/findAll');
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('restaurantUser/findAll');
        }
    }
    
    /**
     * Get the check users.
     * @param String $post The post that contains the checked values
     * @return array \Model_RestaurantUser
     */
    private function getCheckUsers($post) {
        $userRepo = new Repository_User();
        $users = $userRepo->getAll();
        
        $restaurantRepo = new Repository_Restaurant();
        $restaurants = $restaurantRepo->getAll();
        
        $restaurantsUsers = array();
        foreach ($restaurants as $r) {
            $currentRestaurant = array();
            foreach ($users as $u) {
                $isCheck = 0;
                if (isset($post['is_check']) && isset($post['is_check'][$u->getId()][$r->getId()])) {
                    $isCheck = 1;
                }
                $ru = new Model_RestaurantUser($r->getId(), '', $u->getId(), '', $isCheck);
                array_push($currentRestaurant, $ru);
            }
            array_push($restaurantsUsers, $currentRestaurant);
        }
        return $restaurantsUsers;
    }
    
    /**
     * Get the user rights
     * @param \Model_RestaurantUser $restaurantUsers
     * @return array
     */
    private function getUserRights($restaurantUsers) {
        $usersRights = array();
        foreach ($restaurantUsers as $ru) {
            $usersRights[$ru->getIdUser()][$ru->getIdRestaurant()] = 1;
        }
        
        return $usersRights;
    }
}

?>