<?php include("conectar3.php");
$pagina="Listar clientes";
include("head.php");
include("menu.php");
?>
  <div class="container">
       <div class="content">
           <div class="panel panel_default">      
                <div class="pull-right">
                     <a href="addclientes.php" class="btn btn-sm btn-dark">AGREGAR SERVICIO</a>
                </div>
	       <h2>Clientes</h2>
               <hr />
               <div class="table-responsive">
                    <table class="table table-sm table-condensed table-bordered table-hover">
			<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">DNI</th>
				<th scope="col">Número de teléfono</th>
				<th scope="col">Email</th>
				<th scope="col">Dirección</th>
				<th scope="col">Opciones</th>
			</tr>
		        </thead>
			<?php
                        $query=mysqli_query($mysqli, "SELECT * FROM uv028960_reservas.clientes;");
                        $resultado =mysqli_num_rows($query);

                        while($data=mysqli_fetch_array($query)){
                        ?>
                       <tr>
			        <td><?php echo $data["nombreyap"];?></td>
				<td><?php echo $data["dni"];?></td>
				<td><?php echo $data["telefono"];?></td>
				<td><?php echo $data["email"];?></td>
				<td><?php echo $data["direccion"];?></td>
				<td>
				<a class="btn btn-success" href="editarclientes.php?id=<?php echo $data["idclientes"]?>">Editar</a>
				<a class="btn btn-danger" href="delete.php?idclientes=<?php echo $data["idclientes"]?>">Eliminar</a>
				</td>
		      </tr>
                      <?php
                      }
                      ?>
                 </table>
            </div><!--FIN DIV TABLE RESPONSIVE-->
       <div style='padding: 8px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Pagina <?php echo $paginaNro." de ".$totalPaginas; ?></strong>
        </div>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php 
                if($paginaNro > 1)
                { ?>
                    <li class="page-item">
                          <?php
                    echo "<a class='page-link' href='?pagina_nro=1'>&lsaquo;&lsaquo;</a>";
                    ?>
                    </li><?php
                } 
            ?>
            
            <li class="page-item">
                <a class="page-link"<?php if($paginaNro > 1){ echo "href='?pagina_nro=$paginaAnterior'"; } ?>>&lsaquo;</a>
            </li>
            
            <li class="page-item">
                <a class="page-link"<?php if($paginaNro < $totalPaginas) { echo "href='?pagina_nro=$paginaSiguiente'";} ?>>&rsaquo;</a>
            </li>
        
            <?php 
                if($paginaNro < $totalPaginas)
                {
                    ?>
                    <li class="page-item">
                        <?php
                    echo "<a class='page-link' href='?pagina_nro=$totalPaginas'>&rsaquo;&rsaquo;</a>";
                    ?>
                    </li>
                <?php
                } 
            ?>
        </ul>
        </nav>
    </div>
    </div>
       <?php
include("pie.php");
?>
?>
