<?php

class Category {
    // Private members
    private $id;
    private $name;
    private $parent;
    private $fullName;
    
    // Ctr
    /**
     * Constructor of a category model
     * @param int $id the id of the category
     * @param string $name the name of the category
     * @param int $parentId the id of the parent category
     * @param string $fullname the fullname of the category
     */
    public function __construct($id, $name, $parent, $fullName) {
        $this->setId($id);
        $this->setName($name);
        $this->setParent($parent);
        $this->setFullName($fullName);
    }
   
    // Getters and setters
    /**
     * Get the id of the category
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the category
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the category
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the category
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Get the parent id of the category
     * @return int
     */
    public function getParent() {
        return $this->parent;
    }
    
    /**
     * Set the parent id of the category
     * @param int $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }
    
        /**
     * Get the full name of the category
     * @return string
     */
    public function getFullName() {
        return $this->fullName;
    }
    
    /**
     * Set the full name of the category
     * @param string $fullName
     */
    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }
}

?>