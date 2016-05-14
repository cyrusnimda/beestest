<?php
	
	require_once("../model/GameController.php");
	session_start();

	//TODO use a security to restrict options.
	$action = $_GET["action"];

	$game = new GameController();
	$game->$action();

?>