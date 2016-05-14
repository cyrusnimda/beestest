<?php
	
Class Hive
{
	private $bees = [];
	private $beesTypes = ["QueenBee" => 1, "WorkerBee" => 5, "DroneBee" =>8];

	public function getBees()
	{
		return $this->bees;
	}

	public function getTotalBees()
	{
		return sizeof( $this->bees );
	}

	public function createBees()
	{
		$this->bees = [];	
		foreach ($this->beesTypes as $beetype => $amount) {
			for ($i=0; $i < $amount; $i++) { 
				$bee = new $beetype;
				$this->bees[] = $bee;
			}
		}
	}

	public function hit()
	{
		$total = sizeof( $this->bees );
		$random = rand(0, $total-1);
		$randomBee = $this->bees[$random];
		$randomBee->hit();
		return $randomBee;
	}

	public function removeBee( $randomBee )
	{
		if( ($key = array_search($randomBee, $this->bees )) !== FALSE) {
	        unset($this->bees[$key]);
	    }

		$this->bees = array_values($this->bees);
	}
}

?>