<?php

	require_once("class/Game.php");
	session_start();

	$game = new Game();
	$game->showBees();

?>