<?php
include "conectar3.php";
if(isset($_GET['idclientes'])){
    $idclientes = $_GET['idclientes'];
    $query = "DELETE FROM clientes WHERE idclientes = $idclientes";
    $resultado = mysqli_query($mysqli, $query);
    header('Location: clientes.php');
}
?>