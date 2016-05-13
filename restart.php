<?php

	session_start();
	$_SESSION["status"] = "new";

	header('Location: index.php');

?>