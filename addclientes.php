<?php include("conectar3.php");
$pagina="Alta de Clientes";
include("head.php");
include("menu.php");
?>
  
  <div class="container">   
                <?php
             if(isset($_POST['add'])){
                $nombreyap      = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombreyap"],ENT_QUOTES))); 
                $dni            = mysqli_real_escape_string($mysqli,(strip_tags($_POST["dni"],ENT_QUOTES))); 
                $telefono       = mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES))); 
                $email          = mysqli_real_escape_string($mysqli,(strip_tags($_POST["email"],ENT_QUOTES))); 
                $direccion      = mysqli_real_escape_string($mysqli,(strip_tags($_POST["direccion"],ENT_QUOTES))); 
                $cek = mysqli_query($mysqli, "SELECT * FROM clientes WHERE idclientes='$idclientes'");
                if(mysqli_num_rows($cek) == 0){
                $insert = mysqli_query($mysqli, "INSERT INTO clientes(nombreyap, dni, telefono, email, direccion)
                VALUES('$nombreyap', '$dni', '$telefono', '$email', '$direccion')") or die(mysqli_error());
                if($insert){
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
               
                }else{
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
                }
                }else{
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
                }
                  
                }
 
            ?>
            <div class="row justify-content-center">
              <div class="col-6 p-3 bg-white shadow-lg rounded">
                <form id="registrocliente" method="post">
                  <h3>Registro de Clientes</h3>
                  <hr>
                 <div class="form-group">
                    <label for="validationServer02">Nombre y Apellido</label> 
                     <input type="text" name="nombreyap" class="form-control" id="nombreyap" placeholder="Nombre y Apellido" required>
                 </div>
                <div class="form-group">
                    <label for="validationServer03">DNI</label>
                    <input type="text" name="dni" class="form-control" id="dni" placeholder="DNI"  required>
                </div>
                 <div class="form-group">
                    <label for="validationServer04">Email</label>
                    <input  id="email" name="email" type="email" class="form-control" placeholder="ejempo@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="validationServer05">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <label for="validationServer06">Dirección</label>
                    <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" required>
                </div>
               <div class="form-group">
                   <label class="col-sm-3 control-label">&nbsp;</label>
                   <div class="col-sm-6">
                     <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
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