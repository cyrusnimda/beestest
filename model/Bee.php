<?php
	
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

    public function isDead()
    {
    	return $this->life < 1;
    }
}

?>