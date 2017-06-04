<?php
		  	$dbhost='localhost';
			$dbuser='root';
			$dbpass='dronechallenge';
			$database='ranking';	
			if(!($iden=mysql_connect($dbhost,$dbuser,$dbpass))){
				die('Error: no se pudo conectar con la base de datos');
			}
			mysql_select_db($database);
			$sql = "SELECT * FROM `EQUIPOS` ORDER BY `SCORE` DESC,`BEST_TIME` ASC";
?>
<?php
	 $result = mysql_query($sql); 
	 echo mysql_num_rows($result);         
 ?>

