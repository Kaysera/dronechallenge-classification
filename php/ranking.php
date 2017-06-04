<!DOCTYPE html>
<html>
	<head>
		<title>Clasificaciones ESII Drone Challenge</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	
	<style>
	.content {
		max-width: 700px;
		margin: auto;
	}
	</style>
	
	<body>
	
		<div class="jumbotron text-center">
			<h2>Clasificaciones ESII Drone Challenge</h2>
			
			<div class="content">
				<div class="container-fluid">
					<div >
						<div class=" col-sm-12 col-xs-12">
							<img  src="../logos/todos.png" alt="todos" style="width:100%">
						</div>	
					</div>
				</div>	
			</div>
		</div>
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
		<div class="content">
			<div class="container-fluid">
				<div class="table-responsive">
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>Posicion</th>
							<th>Equipo</th>
							<th>Puntuacion Total</th>
							<th>Tiempo Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$result = mysql_query($sql);
			               while ($row = mysql_fetch_array($result)) {?>
			                   <tr>
			                   <td><?php echo $row['TEAM'];?></td>
			                   <td><?php echo $row['SCORE'];?></td>
			                   <td><?php echo $row['BEST_TIME'];?></td>			                   
			                   </tr>
			              <?php  } ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	 	<script>
			var conn = new WebSocket('ws://dronechallenge.ddns.net:1234');
			conn.onopen = function(e) {
				console.log("Connection established!");
			};
			conn.onmessage = function(e) {
				console.log(e.data);
				updateTable();
			};			
			function updateTable(){				
				//TODO: INSERT LOGIC HERE
			};
		</script>	
		
	</body>
</html>
