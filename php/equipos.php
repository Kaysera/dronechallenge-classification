<!DOCTYPE html>
<html>
	<head>
		<title>Tiempo por Equipo ESII Drone Challenge</title>
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
			<h2>Tiempos por Equipo ESII Drone Challenge</h2>
			
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
						<li class="active"><a href="#">Puntuaciones por Equipo</a></li>	
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="./formulario.php"><span class="icon-bar"></span>Formulario</a></li>
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
		
		<div class="container">
			<div class="col-md-2">
				<div class="container">
					<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Leyenda</button>
					<div id="demo" class="collapse">
						<p><p> 
						PC: Puntuacion del circuito<p>
						TC: Tiempo del circuito<p>
						PT: Puntuacion total<p> 
						TT: Tiempo total<p>
					</div>
				</div>
			</div>
			
			<div class="col-md-2">
				<div class="form-group">
					<label for="sel1"><h3>Equipo</h3></label>
					<select class="form-control" id="Equipo" name="Equipo" form="equipos" onchange="changeTeam.call(this,event)">
							<?php
							$result = mysql_query($sql);
						   while ($row = mysql_fetch_array($result)) {?> 
							   <option><h3><?php echo $row['TEAM'];?></h3></option>			                   
						  <?php }?>
						
					</select>
				</div> 
			</div>
				
			
			<div class="col-md-8">
				<div class="container-fluid">
					<div class="table-responsive" id="table">
					
					</div>
				</div>
	 		</div>
	 		<script>
			var conn = new WebSocket('ws://dronechallenge.ddns.net:1234');
			conn.onopen = function(e) {
				console.log("Connection established!");
			};
			var query1 = "SELECT * FROM `EQUIPOS` WHERE TEAM = ";
			var team = document.getElementById("Equipo").value;
			var querynew = query1.concat(team);
			conn.onmessage = function(e) {
				console.log(e.data);
				$( "#table" ).load( "tableuser.php #newtable", {name: team});
			};

			$( "#table" ).load( "tableuser.php #newtable", {name: team});
			function changeTeam(event){				
				var team = this.options[this.selectedIndex].text;
				var querynew = query1.concat(team);
				$( "#table" ).load( "tableuser.php #newtable", {name: team});
			}
			
		</script>		
	</body>
</html>

