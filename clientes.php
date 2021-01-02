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
                <!--<button type="button" class="btn btn-warning"><a href="add.php">AGREGAR SERVICIO</a></button>-->
            </div>
	<h2>Clientes</h2>
        <hr />
        <table class="table table-bordered">
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Número de teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th></th>
            </tr>
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
            </div>
      </div>
    </div>
      <?php
include("pie.php");
?>
