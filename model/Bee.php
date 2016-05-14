<?php
	
/**
 * Basic Bee class
 * @author  Josu Ruiz
 * @version 1.0 (14/05/2016)
 */
Class Bee
{
	protected $name;
	protected $life;
	protected $pointPerHit;


    public function getName()
    {
    	return $this->name;
    }

    public function getLife()
    {
    	return $this->life;
    }

    public function hit()
    {
    	$this->life -=  $this->pointPerHit;
    	return $this;
    }

    /**
     * Check if the bee is dead
     * @return boolean 
     */
    public function isDead()
    {
    	return $this->life < 1;
    }
}

?>