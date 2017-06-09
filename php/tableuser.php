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
			$team = $_POST['name'];
			$sql = "SELECT * FROM `EQUIPOS` WHERE TEAM = \"".$team."\" ORDER BY `SCORE` DESC,`BEST_TIME` ASC";
		?>		


				<div class="table-responsive" id="newtable">
					<table class="table table-condensed table-striped">
						<thead>
							<tr>								
								<th>Circuito</th>
								<th>Puntuacion</th>
								<th>Tiempo</th>								
							</tr>
						</thead>
						<tbody>
						<?php
							$result = mysql_query($sql);
							$counter = 1;
							$nq = "NO CLASIFICADO"
			               while ($row = mysql_fetch_array($result)) {?>
			                   <tr>	
			                   <td><?php echo $counter; $counter++;?></td>

			                   <td><?php if ($row['SCOREC1'] != 0){
			                   	 echo $row['SCOREC1'];
			                   } else {
			                   	 echo $nq;
			                   }
			                   ?></td>

			                   <td><?php echo substr($row['TIMEC1'], 3, 9);?></td>
			                   </tr><tr>
			                    <td><?php echo $counter; $counter++;?></td>
			                   <td><?php echo $row['SCOREC2'];?></td>
			                   <td><?php echo substr($row['TIMEC2'], 3, 9);?></td>	
			                   </tr><tr>
			                    <td><?php echo $counter; $counter++;?></td>
			                   <td><?php echo $row['SCOREC3'];?></td>
			                   <td><?php echo substr($row['TIMEC3'], 3, 9);?></td>				                   
			                   </tr>
			              <?php  }?>			              
					</tbody>
					</table>
				
				</div>			
	 	<script>			
			
		</script>	
		
	</body>
</html>

