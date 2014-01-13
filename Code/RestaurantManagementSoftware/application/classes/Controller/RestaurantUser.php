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
        // Get all the informations from the repository.
        $repo = new Repository_RestaurantUser();
        $restaurantantsUsers = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('restaurant/restaurants_users')
                    ->set('restaurantantsUsers', $restaurantantsUsers);
        
        $this->template->title = __('User Access Management');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the edition of a user access to restaurants.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ('RestaurantUser/findAll');
        }
        
        // Get the restaurant
        $restoRepo = new Repository_Restaurant();
        $restaurant = $restoRepo->get($id);
        
        // Get the restaurant users
        $repo = new Repository_RestaurantUser();
        $restaurantUsers = $repo->getRestaurantUsers($id);

        // The id do not refer to a valid restaurant
        if (!is_object($restaurant)) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ('RestaurantUser/findAll');
        }

        $pageName = 'User Access Management for ' . $restaurant->getName();
        $view = View::factory('restaurant/restaurant_users')
                ->set('restaurantUsers', $restaurantUsers)
                ->set('id_restaurant', $restaurant->getId())
                ->set('submitAction', 'RestaurantUser/save')
                ->set('pageName', $pageName);
        
        $this->template->title = __($pageName);
        $this->template->content = $view;
    }
    
    /**
     * Save the user access to a restaurant.
     */
    public function action_save() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $isCheck = (isset($_POST['is_check'])) ? $_POST['is_check'] : array();
            $users = $this->getformattedCheckUsers($isCheck);
            $idRestaurant = $_POST['id_restaurant'];
                        
            // Check back all the elements that were checked by the user
            $repo = new Repository_RestaurantUser();
            $restaurantUsers = $repo->getRestaurantUsers($idRestaurant);
            foreach ($restaurantUsers as $ru) {
                if (in_array($ru->getIdUser(), $isCheck)) {
                    $ru->setIsCheck(1);
                } else {
                    $ru->setIsCheck(0);
                }
            }
            
            // Subscribe or Unsubcribe user to give them access to the restaurant
            $success = $repo->subscribeOrUnsubcribeUsersToRestaurant($idRestaurant, $restaurantUsers);

            // Redirect if the update was successful
            if ($success) {
                Session::instance()->set('feedbackMessage', array('The user access were updated.'));
                $this->redirect ('restaurantUser/findAll');
            }
            
            // An error occured - load all the element in the view to try again
            // Get the restaurant
            $restoRepo = new Repository_Restaurant();
            $restaurant = $restoRepo->get($idRestaurant);
            $pageName = 'User Access Management for ' . $restaurant->getName();
            
            $view = View::factory('restaurant/restaurant_users')
                ->set('restaurantUsers', $restaurantUsers)
                ->set('id_restaurant', $restaurant->getId())
                ->set('submitAction', 'RestaurantUser/save')
                ->set('pageName', $pageName);
        
            $this->template->title = __($pageName);
            $this->template->feedbackMessage = array('An error occured.');
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('restaurantUser/findAll');
        }
    }
    
    /**
     * Get the check users in a specific format (userid1, userid2, ...)
     */
    private function getformattedCheckUsers($checkedValues) {
        $formattedStr = '';
        foreach($checkedValues as $value){
            $formattedStr .= $value.',';
        }
        return $formattedStr;
    }
}

?>