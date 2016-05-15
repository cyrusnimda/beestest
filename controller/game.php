<?php
	// Start session.
	require_once("GameController.php");
	session_start();

	//TODO use a security to restrict actions.
	$action = $_GET["action"];

	// Run selected action.
	$game = new GameController();
	$game->$action();

?>