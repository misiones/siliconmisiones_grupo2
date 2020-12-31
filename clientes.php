<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de clientes</title>
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
    <div id="container">
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
</body>
</html>