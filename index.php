<?php

	/**
	 * @todo use some auto initializer. 
	 */
	require_once("model/Hive.php");
	require_once("model/Bee.php");
	require_once("model/QueenBee.php");
	require_once("model/WorkerBee.php");
	require_once("model/DroneBee.php");
	require_once("controller/GameController.php");

	// Start session.
	session_start();

	// Get action.
	if( !isset( $_GET["action"] ) ){
		$action = "showIndex";
	} else{
		$action = $_GET["action"];
	}

	/**
	 * @todo use better security to restrict actions.
	 */
	$allowed_actions = ["showIndex", "start", "hit"];
	if ( !in_array($action, $allowed_actions) ){
		die("Action not allowed.");
	}

	// Run selected action.
	$game = new GameController();
	$game->$action();

?>