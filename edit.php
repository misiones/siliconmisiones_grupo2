<?php include("conectar3.php");
?>
<html>
<head>
  <title>Datos</title>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editar servicios</title>
 
	<!-- Bootstrap -->
	<link href="bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
 
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
           <a class="nav-link" href="servicios.php">Servicios <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
           <a class="nav-link" href="alojamientos.php">Alojamientos <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
           <a class="nav-link" href="clientes.php">Clientes <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
           <a class="nav-link" href="reservas.php">Reservas <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
           <a class="nav-link" href="pagos.php">Pagos <span class="sr-only">(current)</span></a>
          </li>
        </ul>  
         <!-- <form class="form-inline my-2 my-lg-0" action="login.php">
             <input class="form-control mr-sm-2" type="text" placeholder="Usuario" name="username">
             <input class="form-control mr-sm-2" type="text" placeholder="Contraseña" name="psw">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
         </form>-->
    </div>
	
    </nav>
  
   

	<div class="container">
		<div class="content">
			
			<h2>Editar servicios</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$id = mysqli_real_escape_string($mysqli,(strip_tags($_GET["id"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM servicios WHERE idservicios='$id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$idservicios             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["idservicios"],ENT_QUOTES))); 
				$descripcion             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["descripcion"],ENT_QUOTES))); 
				
				$update = mysqli_query($mysqli, "UPDATE servicios SET  descripcion='$descripcion' WHERE idservicios='$idservicios'") or die(mysqli_error());
				if($update){
					//header("Location: edit.php?id=".$idservicios."&pesan=si");
					echo "<script>alert('Los datos han sido actualizados!'); window.location = 'servicios.php'</script>";
				}else{
					echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'servicios.php'</script>";
                   //echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="idservicios" value="<?php echo $row ['idservicios']; ?>" class="form-control" placeholder="Servicio" class="form-control span8 tip" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripcion</label>
					<div class="col-sm-4">
						<input type="text" name="descripcion" value="<?php echo $row ['descripcion']; ?>" class="form-control" placeholder="Descripcion" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="servicios.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>