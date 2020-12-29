<?php
include "conectar3.php";
if(isset($_GET['dni'])){
    $dni = $_GET['dni'];
    $query = "DELETE FROM clientes WHERE dni = $dni";
    $resultado = mysqli_query($mysqli, $query);
    header('Location: clientes.php');
}
?>