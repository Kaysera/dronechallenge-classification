<!DOCTYPE html>
<html>
	<head>
		<title>Clasificaciones ESII Drone Challenge</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="refresh" content="0;url=../index.html"/>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	
	<body>
	
		<?php
		  	$dbhost='localhost';
			$dbuser='root';
			$dbpass='dronechallenge';
			$database='ranking';	
			if(!($iden=mysql_connect($dbhost,$dbuser,$dbpass))){
				die('Error: no se pudo conectar con la base de datos');
			}
			mysql_select_db($database);
			$sql = "SELECT * FROM `PARRILLA` ORDER BY `SCORE` DESC,`BEST_TIME` ASC";
		?>		
				<div class="table-responsive" id="newtable">
				<table class="table table-condensed table-striped" >
					<thead>
						<tr>
							<th>Posicion</th>
							<th>Equipo</th>
							<th>Puntuacion</th>
							<th>Tiempo</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$result = mysql_query($sql);
							$counter = 1;
			               while ($row = mysql_fetch_array($result)) {?>
			                   <tr>
			                   <td><?php echo $counter;?></td>
			                   <td><?php echo $row['TEAM'];?></td>
			                   <td><?php echo $row['SCORE'];?></td>
			                   <td><?php echo substr($row['BEST_TIME'], 3, 9);?></td>			                   
			                   </tr>
			              <?php  $counter++;}?>
					</tbody>
				</table>
				</div>			
	 	<script>			
			
		</script>	
		
	</body>
</html>

