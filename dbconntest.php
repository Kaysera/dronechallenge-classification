<?php
	$dbhost='localhost';
	$dbuser='root';
	$dbpass='dronechallenge';
	$database='prueba';
	$reponse=array();
	if(!($iden=mysql_connect($dbhost,$dbuser,$dbpass))){
		die('Error: no se pudo conectar con la base de datos');
	}
	mysql_select_db($database);
	$team = 'Equipo1';
	$track='Pista1';
	$red=2;
	$green=2;
	$blue=2;
	$order=2;
	$base=1;
	$laptime='00:30:00';	
	$sql="INSERT INTO `REGISTROS`(`RED`) VALUES ($red)";	
	if(!(mysql_query($sql))){
						$response['success']=0;
						echo "cosa"
						die('Error: no se pudo ejecutar la consulta');
					}else{
						echo "Viva"
					}
	mysql_close($iden);
?>

