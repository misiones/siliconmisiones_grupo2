<?php include("conectar3.php");
$pagina="Editar reservas";
include("head.php");
include("menu.php");
?>
	<div class="container">
		<div class="content">
			
           <h2>Editar reservas</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$id = mysqli_real_escape_string($mysqli,(strip_tags($_GET["id"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM reservas WHERE idreservas='$id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$idreservas             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["idreservas"],ENT_QUOTES))); 
				$fecha             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["fecha"],ENT_QUOTES));
				$fechadesde             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["fechadesde"],ENT_QUOTES)); 
				$fechahasta             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["fechahasta"],ENT_QUOTES));
                $comentario             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["comentario"],ENT_QUOTES))); 
                $clientes_idclientes             = mysqli_real_escape_string($mysqli,(strip_tags($_POST["clientes_idclientes"],ENT_QUOTES));
                $usuario_idusuario            = mysqli_real_escape_string($mysqli,(strip_tags($_POST["usuario_idusuario"],ENT_QUOTES))); 

				$update = mysqli_query($mysqli, "UPDATE reservas SET  comentario='$comentario', fechadesde='$fechadesde', fechahasta='$fechahasta', clientes_idclientes= '$clientes_idclientes', usuario_idusuario= '$usuario_idusuario'  WHERE idreservas='$idreservas'") or die(mysqli_error());
				if($update){
					//header("Location: edit.php?id=".$idservicios."&pesan=si");
					echo "<script>alert('Los datos han sido actualizados!'); window.location = 'reservas.php'</script>";
				}else{
					echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'reservas.php'</script>";
                   //echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
		?>
 
 

			<form class="form-horizontal" action="" method="post">
			
			<div class="form-row">
			    <div class="col-md-3 mb-1">
                  <label for="validationServer01">Número de reserva:</label>
                    <input type="text" disabled class="form-control" id="CodigoFactura" value="<?php echo $codigofactura; ?>">
                 </div>
                  <div class="col-md-3 mb-1">
                   <label for="validationServer02">Fecha:</label>
                    <input type="text" disabled class="form-control" id="Fecha" value="<?php echo $fecha; ?>">
                 </div>
              
                <div class="col-md-3 mb-1">
			      <label for="validationServer03">Fecha Desde</label>
			      <input type="date" class="form-control" id="validationServer03" placeholder="Fecha desde" value="" required>
			      
			    </div>
			    <div class="col-md-3 mb-1">
			      <label for="validationServer04">Fecha Hasta</label>
			      <input type="date" class="form-control" id="validationServer04" placeholder="Fecha hasta" value="" required>
			      			     
			    </div>
  			</div>
			<div class="form-row">
			    <div class="col-md-6 mb-3">
			      <label for="validationServer05">Comentario</label>
			      <input type="textarea" class="form-control" id="validationServer05" placeholder="Escribir un comentario" required>
			  
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationServer06">Cliente</label>
			      <select class="form-control" id="exampleFormControlSelect1"><option value="0">Seleccione:</option>
                   <?php
                   $query = $mysqli -> query ("SELECT * FROM clientes");
                   while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores[idclientes].'">'.utf8_encode($valores[nombreyap]).'</option>';
                   }
                  ?>
                 </select>
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationServer07">Usuario</label>
			      <select class="form-control" id="exampleFormControlSelect1"><option value="0">Seleccione:</option>
                   <?php
                   $query = $mysqli -> query ("SELECT * FROM usuario");
                   while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores[idusuario].'">'.utf8_encode($valores[nombre]).'</option>';
                   }
                  ?>
                 </select>
			    </div>
			 </div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-4">
						<div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
				          <label class="form-check-label" for="inlineRadio1">1-En proceso</label>
				       </div>
				       <div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
				          <label class="form-check-label" for="inlineRadio2">2-Confirmado</label>
				       </div>
				       <div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
				          <label class="form-check-label" for="inlineRadio3">3-Cancelado (disabled)</label>
				       </div>
					</div>
				</div>
				<div class="form-group">
					 <div class="row mt-4">
					      <div class="col-md">
					        <table class="table table-striped">
					          <thead>
					            <tr>
					              <th>Código de Alojamiento</th>
					              <th>Descripción</th>
					              <th class="text-right">Cantidad de personas</th>
					              <th class="text-right">Adultos</th>
					              <th class="text-right">Niños</th>
					            </tr>
					          </thead>
					          <tbody id="DetalleFactura">
					          	<?php
                  	 $sentencia = $mysqli ->prepare("select hospedaje.idhospedaje as idhospedaje,descripcion as descripcion,detallereservas.* from detallereservas as detallereservas join hospedaje as hospedaje on hospedaje.idhospedaje=detallereservas.hospedaje_idhospedaje where detallereservas.reservas_idreservas=".$id")"; 

                   				 $sentencia->execute();
                    			$resultado = $sentencia->get_result();
                    			$fila = $resultado->fetch_assoc();
                 		 
                    			while($fila)
                    			{         ?>
                              	<tr>  
                              	<?php
                              		echo "<td scope='row'>".$fila['idhospedaje']."</td>
                                    <td>".utf8_encode($fila['descripcion'])."</td>
                                    <td>".$fila['cantidadpersonas']."</td>
                                    <td>".$fila['adultos']."</td>
                                    <td>".utf8_encode($fila['niños'])."</td>";
                                    ?>
                                </tr>
                              <?php 
                       				 $fila = $resultado->fetch_assoc();
                    			}

                    			mysqli_close($mysqli);
    
                		?>
           				 </tbody>  
           				 
					     </table>
					 
					      </div>
					    </div>
					       <button type="button" id="btnAgregarProducto" class="btn btn-success">Agregar Alojamiento</button>
					     <button type="button" id="btnTerminarFactura" class="btn btn-success">Terminar Reserva</button>
					     
					</div>
   
       <?php
include("pie.php");
?>
