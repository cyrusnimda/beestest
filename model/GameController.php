<?php

require_once("Hive.php");
require_once("Bee.php");
require_once("QueenBee.php");
require_once("WorkerBee.php");
require_once("DroneBee.php");
	
Class GameController
{
	private $hive;

	public function __construct()
	{
		$this->initHive();
	}

	private function initHive()
	{
		if( $this->gameInProgress() ){
			$this->loadHiveFromSession();
		} else{
			$this->hive = new Hive();
		}
	}

	public function start()
	{
		$this->hive->createBees();
		$this->updateHiveInSession();
		$_SESSION["status"] = "progress";
		$this->showHive();
	}

	public function hit()
	{
		$randomBee = $this->hive->hit();
		if( $randomBee->isDead() ){
			if( $randomBee->getName()=="Queen" ){
				$this->showLoose();
			}
			$this->hive->removeBee( $randomBee );
		}
		
		$this->updateHiveInSession();
		$this->showHive();
	}

	public function showLoose()
	{
		require_once("../view/loose.php");
		die();
	}

	public function showHive()
	{
		$hive = $this->hive;
		require_once("../view/showHive.php");
	}

	public function getHive()
	{
		return $this->hive;
	}

	private function gameInProgress()
	{
		return $_SESSION["status"] == "progress";
	}

	private function updateHiveInSession()
	{
		$_SESSION["hive"] = $this->hive;
	}

	private function gameIsLost()
	{
		return $this->hive->getTotalBees() == 0;
	}

	private function loadHiveFromSession()
	{
		$this->hive = $_SESSION["hive"];
		if( $this->gameIsLost() ){
			$_SESSION['status'] = "end";
			$this->showLoose();
		}
	}
}

?>