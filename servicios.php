<?php include("conectar3.php");
$pagina="Listar servicios";
include("head.php");
include("menu.php");
?>
  
   
	<div class="container">
		<div class="content">
       <div class="panel panel_default">      

            <div class="pull-right">
                <a href="add.php" class="btn btn-sm btn-dark">AGREGAR SERVICIO</a>
                <!--<button type="button" class="btn btn-warning"><a href="add.php">AGREGAR SERVICIO</a></button>-->
            </div>
           <?php
               if(isset($_GET['action']) == 'delete'){
                  $id_delete = intval($_GET['idservicios']);
                  $query = mysqli_query($mysqli, "SELECT * FROM servicios WHERE idservicios='$id_delete'");
                  if(mysqli_num_rows($query) == 0){
                  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                   }else{
                   $delete = mysqli_query($mysqli, "DELETE FROM servicios WHERE idservicios='$id_delete'");
                   if($delete){
                   echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Los datos han sido eliminados correctamente.</div>';
                   }else{
                   echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.(hay tablas relacionadas)</div>';
                   }
                  }
                }
              ?>
			<h2>Servicios</h2>
            <hr />
			
          <div class="table-responsive">
           <table class="table table-sm table-condensed table-bordered table-hover">
            <thead>
            <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include('conectar3.php');
                    
                    //############## SI HUBO UN METODO GET Y ME TRAJO EL NUMERO DE PAGINA, LO USO. SI NO, ESTABLEZCO UNO POR DEFECTO (EMPEZANDO DEL PRINCIPIO) ##############
                    if (isset($_GET['pagina_nro']) && $_GET['pagina_nro'] != "") 
                    {
                        $paginaNro = $_GET['pagina_nro'];
                    } 
                    else 
                    {
                        $paginaNro = 1;
                    }

                    //############## DEFINO UN MAXIMO DE ELEMENTOS POR PAGINA ##############
                    $cantidadMaximaElementosPagina = 4;
                    
                    //############## CALCULO VALORES PARA LA PAGINACION ##############
                    $offset = ($paginaNro - 1) * $cantidadMaximaElementosPagina;
                    $paginaAnterior = $paginaNro - 1;
                    $paginaSiguiente = $paginaNro + 1;
                
                    //############## REALIZO LA CONSULTA PARA SABER CUANTOS ELEMENTOS HAY EN TOTAL ##############
                    $sentencia = $mysqli->prepare("SELECT COUNT(*) as cantidad FROM servicios");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();

                    //############## GUARDO LA CANTIDAD TOTAL DE ELEMENTOS EN UNA VARIABLE ##############
                    $cantidadTotalElementos = $fila["cantidad"];

                    //############## CALCULO LA CANTIDAD DE PAGINAS QUE NECESITO ##############
                    $totalPaginas = ceil($cantidadTotalElementos / $cantidadMaximaElementosPagina);

                    //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                    $sentencia = $mysqli->prepare("SELECT * FROM servicios LIMIT $offset, $cantidadMaximaElementosPagina");
                     //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                   
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();
                  
                    while($fila)
                    {         ?>
                              <tr>  
                              <?php
                              echo "<td scope='row'>".$fila['idservicios']."</td>
                                    <td>".$fila['descripcion']."</td>";
                                ?>
                                    <td>
                                    <div class="btn-toolbar" role="toolbar">
                                       <div class="btn-group mr-5" role="group">
                                          <button type='button' class="btn btn-outline-success my-2 my-sm-0"> 
                                          <?php
                                          echo "<a class='\page-link\' href=edit.php?id=".$fila['idservicios'].">EDITAR</a>
                                          </button>";
                                          ?> 
                                        </div>
                                        <div class="btn-group mr-5" role="group">
                                          <button type='button' class="btn btn-outline-warning my-2 my-sm-0"> 
                                           <?php
                                           echo "<a href=servicios.php?action=delete&idservicios=".$fila['idservicios'].">ELIMINAR</a>";
                                          // echo "<a href=servicios.php?action=delete&idservicios=".$fila['idservicios']."data-toggle='tooltip' title='Eliminar' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i></a>";
                                          ?>
                                          </button>

                                         
  
                                           
                                        </div>
                                    </div>
                                   </td>
                                </tr>
                              <?php 
                        $fila = $resultado->fetch_assoc();
                    }

                    mysqli_close($mysqli);
    
                ?>
            </tbody>
        </table>

        </div>
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