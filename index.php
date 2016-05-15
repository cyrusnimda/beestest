<?php

	//TODO: use some auto initializer. 
	require_once("model/Hive.php");
	require_once("model/Bee.php");
	require_once("model/QueenBee.php");
	require_once("model/WorkerBee.php");
	require_once("model/DroneBee.php");
	require_once("controller/GameController.php");

	// Start session.
	session_start();

	if( !isset( $_GET["action"] ) ){
		// Show index page.
		require_once("view/index.php");
	} else{
		//TODO use a security to restrict actions.
		$action = $_GET["action"];
		
		// Run selected action.
		$game = new GameController();
		$game->$action();
	}

?>