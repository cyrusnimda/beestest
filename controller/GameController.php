<?php

/**
 * Game controller, used to handle the hive, the session, etc.
 * 
 * @author  Josu Ruiz
 * @version 1.0 (15/05/2016)
 */	
Class GameController
{
	private $hive;

	public function __construct()
	{
		$this->initHive();
	}

	public function getHive()
	{
		return $this->hive;
	}

	/**
	 * Get the hive from session or crete a new one if needed.
	 */
	private function initHive()
	{
		if( $this->gameInProgress() ){
			$this->loadHiveFromSession();
		} else{
			$this->hive = new Hive();
		}
	}

	/**
	 * ***************   ACTION    ***************
	 * Show index page.
	 * 
	 */
	public function showIndex()
	{
		require_once("view/index.php");
	}

	/**
	 * ***************   ACTION    ***************
	 * Creates the bees and show the initial state.
	 * 
	 */
	public function start()
	{
		$this->hive->createBees();
		$this->updateHiveInSession();
		$_SESSION["status"] = "progress";
		$this->showHive();
	}

	/**
	 * ***************   ACTION    ***************
	 * Hit the hive will hit a bee inside at random,
	 * after that will check if the queen is dead.
	 */
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
		require_once("view/loose.php");
		die();
	}

	public function showHive()
	{
		$hive = $this->hive;
		require_once("view/showHive.php");
	}


	/**
	 * Check if the game is still in progress
	 * @return Bool
	 */
	private function gameInProgress()
	{
		if( !isset($_SESSION["status"]) ){
			return false;
		}
		return $_SESSION["status"] == "progress";
	}

	private function updateHiveInSession()
	{
		$_SESSION["hive"] = $this->hive;
	}

	/**
	 * Check if there are no bees alive
	 * @return Bool
	 */
	private function gameIsLost()
	{
		return $this->hive->getTotalBees() == 0;
	}

	/**
	 * Get the hive data from session.
	 * If the game is lost, show that view.
	 */
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