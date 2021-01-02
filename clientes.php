<?php include("conectar3.php");
$pagina="Listar clientes";
include("head.php");
include("menu.php");
?>
  
    <div class="container">
        <h1>Lista de clientes</h1> 
        <a href="addclientes.php" class="btn btn-primary">Agregar cliente</a>
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
            include 'conectar3.php';
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
      <?php
include("pie.php");
?>
