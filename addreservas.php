<?php include("conectar3.php");
$pagina="Alta de reservas";
include("head.php");
include("menu.php");
?>
	<div class="container">
		<div class="content">
			<h2>Agregar reservas</h2>
			<hr />
 
 
			<form class="form-horizontal" action="" method="post">
			
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha</label>
					<div class="col-sm-4">
						<?php
						 $Hora = date('H') - 3;?>
						<input type="datetime-local"  value="<?php echo date('d-m-Y \ '.$Hora.':i:s'); ?>" class="form-control" name="fecha" placeholder="Fecha" class="form-control span8 tip" readonly="readonly">
					
					
		        </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha Desde</label>
					<div class="col-sm-4">
						<input type="date" name="fechadesde" class="form-control" placeholder="Fecha Hasta" required>
		        </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha Hasta</label>
					<div class="col-sm-4">
						<input type="date" name="fechahasta" class="form-control" placeholder="Fecha Hasta" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="exampleFormControlTextarea1">Comentario</label>
					<div class="col-sm-4">
						<input type="textarea" name="comentario" class="form-control" placeholder="Comentario" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-4">
						<div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
				          <label class="form-check-label" for="inlineRadio1">En proceso</label>
				       </div>
				       <div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
				          <label class="form-check-label" for="inlineRadio2">Confirmado</label>
				       </div>
				       <div class="form-check form-check-inline">
				          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
				          <label class="form-check-label" for="inlineRadio3">Cancelado (disabled)</label>
				       </div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="exampleFormControlSelect1">Cliente</label>
                 	<div class="col-sm-4">
                   <select class="form-control" id="exampleFormControlSelect1"><option value="0">Seleccione:</option>
                   <?php
                   $query = $mysqli -> query ("SELECT * FROM clientes");
                   while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores[idclientes].'">'.utf8_encode($valores[nombreyap]).'</option>';
                   }
                  ?>
                 </select>
	        		</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="exampleFormControlSelect1">Usuario</label>
					<div class="col-sm-4">
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
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="reservas.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
       <?php
include("pie.php");
?>
