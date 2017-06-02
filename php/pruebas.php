<?php
	$laptime="358.253";
	$minutes=0;
	while ($laptime > 60){
		$laptime = $laptime - 60;
		$minutes = $minutes + 1;
	}
	echo $minutes .":". $laptime;
	
?>

