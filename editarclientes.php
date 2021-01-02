<?php include("conectar3.php");
$pagina="Alta de Clientes";
include("head.php");
include("menu.php");
?>
   <div class="container">
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$id = mysqli_real_escape_string($mysqli,(strip_tags($_GET["id"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM clientes WHERE idclientes='$id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$idclientes             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["idclientes"],ENT_QUOTES))); 
                $nombreyap             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombreyap"],ENT_QUOTES))); 
                $dni             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["dni"],ENT_QUOTES))); 
                $telefono            = mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES))); 
                $email            = mysqli_real_escape_string($mysqli,(strip_tags($_POST["email"],ENT_QUOTES))); 
                $direccion             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["direccion"],ENT_QUOTES))); 

				$update = mysqli_query($mysqli, "UPDATE clientes SET  nombreyap='$nombreyap', dni='$dni', telefono='$telefono', email= '$email', direccion= '$direccion'  WHERE idclientes='$idclientes'") or die(mysqli_error());
				if($update){
					//header("Location: edit.php?id=".$idservicios."&pesan=si");
					echo "<script>alert('Los datos han sido actualizados!'); window.location = 'clientes.php'</script>";
				}else{
					echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'clientes.php'</script>";
                   //echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			
			?>
			
			<div class="row justify-content-center">
              <div class="col-6 p-3 bg-white shadow-lg rounded">
                <form id="registrocliente" method="post">
                  <h3>Editar Cliente</h3>
                  <hr>
                 <div class="form-group">
				    <label for="validationServer01">Id</label>
					<input type="text" name="idclientes" value="<?php echo $row ['idclientes']; ?>" class="form-control" placeholder="" class="form-control span8 tip" readonly="readonly">
				</div>
                 <div class="form-group">
                    <label for="validationServer02">Nombre y Apellido</label> 
                     <input type="text" name="nombreyap" value="<?php echo $row ['nombreyap']; ?>" class="form-control" id="nombreyap" placeholder="Nombre y Apellido" required>
                 </div>
                <div class="form-group">
                    <label for="validationServer03">DNI</label>
                    <input type="text" name="dni" value="<?php echo $row ['dni']; ?>" class="form-control" id="dni" placeholder="DNI"  required>
                </div>
                 <div class="form-group">
                    <label for="validationServer04">Email</label>
                    <input  id="email" name="email" value="<?php echo $row ['email']; ?>"type="email" class="form-control" placeholder="ejempo@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="validationServer05">Teléfono</label>
                    <input type="text" name="telefono" value="<?php echo $row ['telefono']; ?>"class="form-control" id="telefono" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <label for="validationServer06">Dirección</label>
                    <input type="text" name="direccion" value="<?php echo $row ['direccion']; ?>"class="form-control" id="direccion" placeholder="Dirección" required>
                </div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="clientes.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
       </div>
     </div>
  </div>
       <?php
include("pie.php");
?>