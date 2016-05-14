<?php

/**
 * @author  Josu Ruiz
 * @version 1.0 (14/05/2016)
 */
Class Hive
{
	private $bees = [];
	//TODO use a config file for this.
	private $beesTypes = ["QueenBee" => 1, "WorkerBee" => 5, "DroneBee" =>8];

	public function getBees()
	{
		return $this->bees;
	}

	public function getTotalBees()
	{
		return sizeof( $this->bees );
	}

	/**
	 * Populate the bees array
	 * @return True
	 */
	public function createBees()
	{
		$this->bees = [];	
		foreach ($this->beesTypes as $beetype => $amount) {
			for ($i=0; $i < $amount; $i++) { 
				$bee = new $beetype;
				$this->bees[] = $bee;
			}
		}
		return true;
	}

	/**
	 * Hit a random bee in the hive
	 * @return Bee   The hited bee
	 */
	public function hit()
	{
		$total = sizeof( $this->bees );
		$random = rand(0, $total-1);
		$randomBee = $this->bees[$random];
		$randomBee->hit();
		return $randomBee;
	}

	/**
	 * Remove a bee from the hive
	 * @param  Bee              The bee to remove  
	 * @return True
	 */
	public function removeBee( $randomBee )
	{
		if( ($key = array_search($randomBee, $this->bees )) !== FALSE) {
	        unset($this->bees[$key]);
	    }

		$this->bees = array_values($this->bees);
		return true;	
	}
}

?>