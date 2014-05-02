<?php

class Supplier {
    // Private members
    private $id;
    private $name;
    
    // Ctr
    /**
     * Constructor of a supplier model
     * @param int $id the id of the supplier
     * @param string $name the name of the supplier
     */
    public function __construct($id, $name) {
        $this->setId($id);
        $this->setName($name);
    }
   
    // Getters and setters
    /**
     * Get the id of the supplier
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the supplier
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the supplier
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the supplier
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
}

?>