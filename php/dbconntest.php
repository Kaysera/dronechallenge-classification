<?php
	
	$contrasena=$_GET['pwd'];
	$masterpass = 123456;
	if ($contrasena == $masterpass){
	$dbhost='localhost';
	$dbuser='root';
	$dbpass='dronechallenge';
	$database='ranking';	
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
			
	$laptime=mysql_real_escape_string($_GET['Tiempo']);
	$minutes=intval($laptime/60);
	$precission=round(($laptime-intval($laptime))*1000);
	$laptime=$laptime%60;
	$laptime="00:".$minutes.":".$laptime.".".$precission;
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
//	echo $sql;
	if(!(mysql_query($sql))) die('Error: no se pudo ejecutar la consulta');
					
	$sql2="SELECT UPDATETIMES()";
	if(!(mysql_query($sql2))) die('Error: no se pudo ejecutar la consulta');
					
	mysql_close($iden);
	header('Location: ../html/Formulario.html');
	}
	else {
		echo "Bad password";
		sleep(3);		
		header('Location: ../html/Formulario.html');
	}
?>

