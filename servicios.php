<?php include("conectar3.php");
?>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listar Servicios</title>
 
	<!-- Bootstrap -->
	<link href="bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="https://fontawesome.com/v3.2.1/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
            
 
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
        <center>
	<p>&copy; Grupo 2 - Programador Web Full Stack - Silicon Misiones <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
