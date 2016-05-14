<h3>The hive has <?=$hive->getTotalBees()?> bees. <a href="/bees/controller/game.php?action=hit"><button>Hit it</button></a> </h3> 

<div>============================</div>

<?php
foreach ($hive->getBees() as $bee) {
	echo "<div>" . $bee->getName() . " -> " . $bee->getLife() . "</div>";
}
?>