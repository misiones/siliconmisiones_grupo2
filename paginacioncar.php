<html>
<head>
  <title>Clase 7</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
    <body>
        <div class="container">
        <h2>Clase 7</h2>
        <p>Ejercicio</p>
          <div class="table-responsive">
           <table class="table table-condensed table-bordered table-hover">
            <thead>
            <tr>
            <th style='width:50px;'>ID</th>
            <th style='width:150px;'>Nombre</th>
            <th style='width:150px;'>Departamento</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include('conectar.php');
                    
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
                    $cantidadMaximaElementosPagina = 2;
                    
                    //############## CALCULO VALORES PARA LA PAGINACION ##############
                    $offset = ($paginaNro - 1) * $cantidadMaximaElementosPagina;
                    $paginaAnterior = $paginaNro - 1;
                    $paginaSiguiente = $paginaNro + 1;
                
                    //############## REALIZO LA CONSULTA PARA SABER CUANTOS ELEMENTOS HAY EN TOTAL ##############
                    $sentencia = $mysqli->prepare("SELECT COUNT(*) as cantidad FROM Empleados");
                    //$sentencia = $mysql->prepare("SELECT COUNT(*) as cantidad FROM Empleados");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();

                    //############## GUARDO LA CANTIDAD TOTAL DE ELEMENTOS EN UNA VARIABLE ##############
                    $cantidadTotalElementos = $fila["cantidad"];

                    //############## CALCULO LA CANTIDAD DE PAGINAS QUE NECESITO ##############
                    $totalPaginas = ceil($cantidadTotalElementos / $cantidadMaximaElementosPagina);

                    //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                    $sentencia = $mysqli->prepare("SELECT Empleados.id,Empleados.nombre, Departamentos.nombre as departamentoNombre FROM Empleados LEFT JOIN Departamentos ON Empleados.departamentoID = Departamentos.id LIMIT $offset, $cantidadMaximaElementosPagina");
                     //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                   
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();
                  
                    while($fila)
                    {         ?>
                              <tr class="success">  
                              <?php
                              echo "<td>".$fila['id']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['departamentoNombre']."</td>
                                    <td></td>";
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
        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Pagina <?php echo $paginaNro." de ".$totalPaginas; ?></strong>
        </div>
        <ul class="pagination pagination-sm">
            <?php 
                if($paginaNro > 1)
                { ?>
                    <li>
                  <?php  
                    echo "<a href='?pagina_nro=1'>&lsaquo;&lsaquo;Primera Pagina</a>";
                ?>
                </li><?php
                } 
            ?>
            
            <li>
                <a <?php if($paginaNro > 1){ echo "href='?pagina_nro=$paginaAnterior'"; } ?>>Anterior</a>
            </li>
            
            <li>
                <a <?php if($paginaNro < $totalPaginas) { echo "href='?pagina_nro=$paginaSiguiente'";} ?>>Siguiente</a>
            </li>
        
            <?php 
                if($paginaNro < $totalPaginas)
                {
                    echo "<li><a href='?pagina_nro=$totalPaginas'>Ultima Pagina &rsaquo;&rsaquo;</a></li>";
                } 
            ?>
        </ul>
       
       
        
    </div>
    </body>
</html>