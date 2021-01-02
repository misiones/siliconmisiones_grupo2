<?php include("conectar3.php");
$pagina="Listar clientes";
include("head.php");
include("menu.php");
?>
  <div class="container">
       <div class="content">
           <div class="panel panel_default">      
                        <div class="pull-right">
                             <a href="addclientes.php" class="btn btn-sm btn-dark">AGREGAR CLIENTE</a>
                        </div>
                        <?php
/////////////////////////////////////////eliminar//////////////////////////////////////////////////////////////
                         
               if(isset($_GET['action']) == 'delete'){
                  $id_delete = intval($_GET['idclientes']);
                  $query = mysqli_query($mysqli, "SELECT * FROM clientes WHERE idclientes='$id_delete'");
                  if(mysqli_num_rows($query) == 0){
                  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                   }else{
                   $delete = mysqli_query($mysqli, "DELETE FROM clientes WHERE idclientes='$id_delete'");
                   if($delete){
                   echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Los datos han sido eliminados correctamente.</div>';
                   }else{
                   echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.(hay tablas relacionadas)</div>';
                   }
                  }
                }
             
/////////////////////////////////////////////////////////////fin eliminar/////////////////////////////////////
 ?>
        	       <h2>Clientes</h2>
                       <hr />
                    <div class="table-responsive">
                        <table class="table table-sm table-condensed table-bordered table-hover">
                		  <thead>
                			<tr>
                                <th scope="col">Id</th>
                				<th scope="col">Nombre</th>
                				<th scope="col">DNI</th>
                				<th scope="col">Número de teléfono</th>
                				<th scope="col">Email</th>
                				<th scope="col">Dirección</th>
                				<th scope="col">Opciones</th>
                			</tr>
                		  </thead>
                          <TBODY>
                                <?php
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
                                    $sentencia = $mysqli->prepare("SELECT COUNT(*) as cantidad FROM clientes");
                                    $sentencia->execute();
                                    $resultado = $sentencia->get_result();
                                    $fila = $resultado->fetch_assoc();

                                    //############## GUARDO LA CANTIDAD TOTAL DE ELEMENTOS EN UNA VARIABLE ##############
                                    $cantidadTotalElementos = $fila["cantidad"];

                                    //############## CALCULO LA CANTIDAD DE PAGINAS QUE NECESITO ##############
                                    $totalPaginas = ceil($cantidadTotalElementos / $cantidadMaximaElementosPagina);

                                    //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                                   
                                    $sentencia = $mysqli ->prepare("SELECT *FROM clientes LIMIT $offset, $cantidadMaximaElementosPagina");
                                     //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                                   
                                    $sentencia->execute();
                                    $resultado = $sentencia->get_result();
                                    $fila = $resultado->fetch_assoc();
                                  
                                    while($fila)
                                    {         ?>
                                              <tr>  
                                              <?php
                                           
                                              echo "<td scope='row'>".$fila['idclientes']."</td>
                                                    <td>".$fila['nombreyap']."</td>
                                                    <td>".$fila['dni']."</td>
                                                    <td>".$fila['telefono']."</td>
                                                    <td>".$fila['email']."</td>
                                                    <td>".$fila['direccion']."</td>";
                                                                                    ?>
                                                    <td>
                                                    <div class="btn-toolbar" role="toolbar">
                                                       <div class="btn-group mr-5" role="group">
                                                          <button type='button' class="btn btn-outline-warning my-2 my-sm-0"> 
                                                          <?php
                                                          echo "<a class='\page-link\' href=editarclientes.php?id=".$fila['idclientes'].">Editar</a>
                                                          </button>";
                                                          ?> 
                                                       </div>
                                                       <div class="btn-group mr-5" role="group">
                                                        <button type='button' class="btn btn-outline-success my-2 my-sm-0"> 
                                                      <?php
                                                         echo "<a href=clientes.php?action=delete&idclientes=".$fila['idclientes'].">Eliminar</a>";
                                                         // echo "<a href=delete.php?&idclientes=".$fila['idclientes'].">Eliminar</a>";
                                                          ?> </button>
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
                   </div><!--FIN DIV TABLE RESPONSIVE-->
                   <!--PAGINACION -->
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
            </div> <!--fin de <div class="panel panel_default"> -->     
           
        </div><!--fin div class content-->
     </div><!--fin div class conteiner-->  
<?php
include("pie.php");
?>
