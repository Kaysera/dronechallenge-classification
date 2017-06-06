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
					<div class="col-sm-12 col-xs-12">
						<img  src="../logos/todos.png" alt="todos" style="width:100%">
					</div>	
				</div>	
			</div>
		</div>
		
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="barra">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="../index.html">Drone Challenge</a></li>
						<li class="active"><a href="#">Ranking</a></li>
						<li><a href="./equipos.php">Puntuaciones por Equipo</a></li>	
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="./formulario.php"><span class="icon-bar"></span>Formulario</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		</div>		
		<div class="content">
			<div class="container-fluid">
				<div class="table-responsive" id="table"></div>
			</div>
		</div>
	 	<script>
			var conn = new WebSocket('ws://dronechallenge.ddns.net:1234');
			conn.onopen = function(e) {
				console.log("Connection established!");
			};
			conn.onmessage = function(e) {
				console.log(e.data);
				$( "#table" ).load( "table.php #newtable" );
			};
			$( "#table" ).load( "table.php #newtable" );
			
		</script>	
		
		

	</body>
</html>

