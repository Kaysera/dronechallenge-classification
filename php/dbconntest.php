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
	$rojo=$_GET['Rojo'];
	$verde=$_GET['Verde'];
	$azul=$_GET['Azul'];
	$orden=$_GET['Order'];
	$vuelta=$_GET['Base'];		
	$laptime=$_GET['Tiempo'];
	$red=0;
	$green=0;
	$blue=0;
	$order=0;
	$base=0;

	if ($rojo) $red = 2;	
	if ($verde) $green = 2;	
	if ($azul == 'on') $blue = 2;	
	if ($orden == 'on')	$order = 2;	
	if ($vuelta == 'on') $base = 1;	

	$sql="INSERT INTO `REGISTROS` (`TEAM`,`TRACK`,`RED`,`GREEN`,`BLUE`,`ORDER`,`BASE`,`LAP_TIME`) VALUES (\"".$team."\",\"".$track."\",$red,$green,$blue,$order,$base,\"".$laptime."\")";	
	if(!(mysql_query($sql))){
						$response['success']=0;
						die('Error: no se pudo ejecutar la consulta');
					}else{
						$response['success']=1;
					}
	mysql_close($iden);
	header('Location: ../html/Formulario.html');
?>

