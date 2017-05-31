<?php
	$dbhost='localhost';
	$dbuser='root';
	$dbpass='dronechallenge';
	$database='ranking';
	$reponse=array();
	if(!($iden=mysql_connect($dbhost,$dbuser,$dbpass))){
		die('Error: no se pudo conectar con la base de datos');
	}
	mysql_select_db($database);
	$team = $_GET['Equipo'];
	$track=$_GET['Circuito'];
	$red=2;
	$green=2;
	$blue=2;
	$order=2;
	$base=1;
	$laptime=$_GET['Tiempo'];	
	$sql="INSERT INTO `REGISTROS` (`TEAM`,`TRACK`,`RED`,`GREEN`,`BLUE`,`ORDER`,`BASE`,`LAP_TIME`) VALUES (\"".$team."\",\"".$track."\",$red,$green,$blue,$order,$base,\"".$laptime."\")";	
	if(!(mysql_query($sql))){
						$response['success']=0;
						die('Error: no se pudo ejecutar la consulta');
					}else{
						$response['success']=1;
					}
	mysql_close($iden);
?>

