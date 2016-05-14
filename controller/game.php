<?php
	
	require_once("../model/GameController.php");
	session_start();

	$action = $_GET["action"];

	$game = new GameController();
	$game->$action();

?>