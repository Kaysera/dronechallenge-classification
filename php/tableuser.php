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
			$sql = "SELECT * FROM `EQUIPOS` WHERE TEAM = \"".$team."\" ORDER BY `SCORE` DESC,`BEST_TIME` ASC ";
		?>		


				<div class="table-responsive" id="newtable">
					<table class="table table-condensed table-striped">
						<thead>
							<tr>
								<th>Equipo</th>
								<th>PC 1</th>
								<th>TC 1</th>
								<th>PC 2</th>
								<th>TC 2</th>
								<th>PC 3</th>
								<th>TC 3</th>
								<th>PT 1</th>
								<th>TT 1</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$result = mysql_query($sql);
							
			               while ($row = mysql_fetch_array($result)) {?>
			                   <tr>			                   
			                   <td><?php echo $row['TEAM'];?></td>
			                   <td><?php echo $row['SCOREC1'];?></td>
			                   <td><?php echo substr($row['TIMEC1'], 3, 9);?></td>
			                   <td><?php echo $row['SCOREC2'];?></td>
			                   <td><?php echo substr($row['TIMEC2'], 3, 9);?></td>	
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

