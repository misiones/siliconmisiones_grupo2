<?php include("conectar3.php");
$pagina="Alta de Clientes";
include("head.php");
include("menu.php");
?>
  
  <div class="container">   
                
            <div class="row justify-content-center">
              <div class="col-6 p-3 bg-white shadow-lg rounded">
                <form id="registrocliente" method="post">
                  <h3>Registro de Clientes</h3>
                  <hr>
                  <div class="form-group">
                    <label for="validationServer01">Id</label>
                     <input type="text" disabled class="form-control" id="idcliente" value="<?php echo $idcliente; ?>">
                 </div>
                 <div class="form-group">
                    <label for="validationServer02">Nombre y Apellido</label> 
                     <input type="text" class="form-control" id="nombre" placeholder="Nombre y Apellido" required>
                 </div>
                <div class="form-group">
                    <label for="validationServer03">DNI</label>
                    <input type="text" class="form-control" id="dni" placeholder="DNI"  required>
                </div>
                 <div class="form-group">
                    <label for="validationServer04">Email</label>
                    <input  id="email" type="email" class="form-control" placeholder="ejempo@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="validationServer05">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <label for="validationServer06">Dirección</label>
                    <input type="text" class="form-control" id="direccion" placeholder="Dirección" required>
                </div>

               <button class="btn btn-primary" type="submit">Enviar</button>
             </form>
            </div>
       </div>
    </div>
       <?php
include("pie.php");
?>