<!DOCTYPE HTML>
<html>
	<head>
		<title>Formulario Puntuaciones ESII Drone Challenge</title>
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
					<div class="col-sm-12 col-xs-12">
						<img  src="../logos/todos.png" alt="todos" style="width:100%">
					</div>	
				</div>	
			</div>
		</div>
		
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#barra">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="barra">
					<ul class="nav navbar-nav">
						<li><a href="../index.html">Drone Challenge</a></li>
						<li><a href="./ranking.php">Ranking</a></li>
						<li><a href="./equipos.php">Puntuaciones por Equipo</a></li>	
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="#"><span class="icon-bar"></span>Formulario</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<?php
		  	$dbhost='localhost';
			$dbuser='root';
			$dbpass='dronechallenge';
			$database='ranking';	
			if(!($iden=mysql_connect($dbhost,$dbuser,$dbpass))){
				die('Error: no se pudo conectar con la base de datos');
			}
			mysql_select_db($database);
			$sql = "SELECT * FROM `EQUIPOS`";
		?>
		<div class="content">
		<div  class="container-fluid">
			<div class="col-sm-10 col-xs-12">
				<form action="../php/dbconntest.php" id="ranking">
				<div class="form-group">
					<label for="sel1"><h3>Equipo</h3></label>
					<select class="form-control" id="Equipo" name="Equipo" form="ranking">
							<?php
							$result = mysql_query($sql);
			               while ($row = mysql_fetch_array($result)) {?> 
			                   <option><h3><?php echo $row['TEAM'];?></h3></option>			                   
			              <?php }?>
						
					</select>
				</div> 
				
				<div class="form-group">
					<label for="sel1"><h3>Circuito</h3></label>
					<select class="form-control" id="Circuito"  name="Circuito" form="ranking">
						<option><h3>Circuito 1</h3></option>
						<option><h3>Circuito 2</h3></option>
						<option><h3>Circuito 3</h3></option>
					</select>
				</div>
				<br>
				
				
					<p class="center">
						<h3>Seleccionar Objetivos:</h3>
						<h4>
						<div>
							<div id="rojo" class="panel panel-danger">
								<div class="panel-heading" ><input type="checkbox" name="Rojo" >  Marco Rojo</div>
							</div>
							
							<div id="verde" class="panel panel-success"> 
								<div class="panel-heading"><input type="checkbox" name="Verde">  Marco Verde<br></div>
							</div>
							
							<div id="azul" class="panel panel-info">
								<div class="panel-heading"><input type="checkbox" name="Azul" >  Marco Azul</div>
							</div>
							
							<div id="orden" class="panel panel-warning">
								<div class="panel-heading"><input type="checkbox" name="Order">  En Orden</div>
							</div>
							
							<div id="base" class="panel panel-warning">	
								<div class="panel-heading"><input type="checkbox" name="Base">  Base</div>
							</div>
						</div>
						</h4>
					</p>
					<br>
					
					<div class="form-group">
						<label for="tyme"><h4>Tiempo(SSS.DCM):</h4></label>
						<input type="text" name="Tiempo" class="form-control" id="tyme" autocomplete="off">
					</div>
					
					<div class="form-group">
						<label for="pwd"><h4>Password:</h4></label>
						<input type="password" name="pwd" class="form-control" id="pwd" autocomplete="off">
					</div>
					
					<div>
						<p>
							<input type="submit" onClick="sendMessage();" value="Enviar la informacion" class="btn btn-primary">
						</p>
					</div>
				</form>
			</div>
		</div>
		</div>
		<script>
			var conn = new WebSocket('ws://dronechallenge.ddns.net:1234');
			conn.onopen = function(e) {
				console.log("Connection established!");
				conn.send('Update me!');
			};			
			function sendMessage(){				
				conn.send('Update me again!');
			}
		</script>
		
		
	<body>

</html>
