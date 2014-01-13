<?php

/* 
 *  <copyright file="Controller_Restaurant.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The controller that handle all the manipulation on restaurants.</summary>
 */
class Controller_Restaurant extends Controller_Template_Generic {
    /**
     * Get all the restaurants.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_Restaurant();
        $restaurants = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('restaurant/restaurants')
                    ->set('restaurants', $restaurants);
        
        $this->template->title = __('Restaurants');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the creation of a restaurant.
     */
    public function action_create() {
        $view = View::factory('restaurant/restaurant');
        $this->template->title = __('Create Restaurant');
        $this->template->content = $view;
    }
    
    /**
     * Add a restaurant.
     */
    public function action_add() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $restaurant = new Model_Restaurant(-1, $post['name'], $post['address']);
            
            if ($post->check()) {
                // Add the restaurant
                $repo = new Repository_Restaurant();
                $success = $repo->add($restaurant);
        
                // Redirect if the add was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The restaurant was added.'));
                    $this->redirect('restaurant/findAll');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('restaurant');
            }
            
            $view = View::factory('restaurant/restaurant')
                    ->set('restaurant', $restaurant)
                    ->set('submitAction', 'restaurant/add');
            $this->template->title = __('Create Restaurant');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('restaurant/findAll');
        }
    }
    
    /**
     * Initiate the edition of a restaurant.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ('restaurant/findAll');
        }
        
        // Get the restaurant to edit
        $repo = new Repository_Restaurant();
        $restaurant = $repo->get($id);

        // The id do not refer to a valid restaurant
        if (!is_object($restaurant)) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ('restaurant/findAll');
        }

        $view = View::factory('restaurant/restaurant')
                ->set('restaurant', $restaurant)
                ->set('submitAction', 'restaurant/update')
                ->set('pageName', 'Edit Restaurant');
        
        $this->template->title = __('Edit Restaurant');
        $this->template->content = $view;
    }
    
    /**
     * Update a restaurant.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $restaurant = new Model_Restaurant($post['id'], $post['name'], 
                                                $post['address']);
            
            if ($post->check()) {
                // Update the restaurant
                $repo = new Repository_Restaurant();
                $success = $repo->update($restaurant);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The restaurant was updated.'));
                    $this->redirect ('restaurant/findAll');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('restaurant');
            }
            
            $view = View::factory('restaurant/restaurant')
                    ->set('restaurant', $restaurant)
                    ->set('submitAction', 'restaurant/update')
                    ->set('pageName', 'Edit Restaurant');
        
            $this->template->title = __('Edit Restaurant');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('restaurant/findAll');
        }
    }
    
    /**
     * Delete a restaurant.
     */
    public function action_delete() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ('restaurant/findAll');
        }
        
        // Delete the restaurant
        $repo = new Repository_Restaurant();
        $success = $repo->delete($id);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array('An error occurred while deleting the restaurant.'));
            $this->redirect ('restaurant/findAll');
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array('The restaurant was deleted.'));
        $this->redirect ('restaurant/findAll');
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getValidationFactory($post) {
        return Validation::factory($post)
                ->rule('name', 'not_empty')
                ->rule('name', 'max_length', array(':value', 100))
                ->label('name', 'Name')
                ->rule('address', 'max_length', array(':value', 250))
                ->label('address', 'Address');
    }
}

?>