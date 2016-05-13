<?php

require_once("Bee.php");
require_once("QueenBee.php");
require_once("WorkerBee.php");
require_once("DroneBee.php");
	
Class Game
{
	private $hive;

	public function __construct()
	{
		

		if( $this->gameInProgress() ){
			$this->loadHiveFromSession();
			$this->hitTheHive();
		} else{
			$this->hive = [];
			$this->createBees();
			$_SESSION["hive"] = $this->hive;
			$_SESSION["status"] = "progress";
		}
	}

	private function gameInProgress()
	{
		return $_SESSION["status"] == "progress";
	}

	private function loadHiveFromSession()
	{
		$this->hive = $_SESSION["hive"];
		if( sizeof($this->hive) == 0 ){
			header('Location: loose.php');
		}
	}

	private function hitTheHive()
	{
		$total = sizeof( $this->hive );
		$random = rand(0, $total-1);
		$randomBee = $this->hive[$random];
		$randomBee->hit();
		if( $randomBee->isDead() ){
			if( $randomBee->getName()=="Queen" ){
				header('Location: loose.php');
			}
			unset($this->hive[$random]);
		}
		$this->hive = array_values($this->hive);
		
		$_SESSION["hive"] = $this->hive;
	}

	private function createBees()
	{
		$beesTypes = ["QueenBee" => 1, "WorkerBee" => 5, "DroneBee" =>8];
		foreach ($beesTypes as $beetype => $amount) {
			for ($i=0; $i < $amount; $i++) { 
				$bee = new $beetype;
				$this->hive[] = $bee;
			}
		}
	}

	public function showBees(){
		$total = sizeof( $this->hive );
		echo "<div>$total bees in the hive <button>Hit it</button></div>";
		echo "<div>============================</div>";
		foreach ($this->hive as $bee) {
			echo "<div>" . $bee->getName() . " -> " . $bee->getLife() . "</div>";
		}
	}
}

?>