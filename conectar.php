
<?php //############## CONEXION A LA BASE ##############
                    $servername = "sistemasmisiones.com.ar";
                    $username = "uv028960_silicon";
                    $password = "silicon1414";
                    $database = "uv028960_pruebas_join";
                    
                    $mysqli = new mysqli($servername, $username, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }//else{echo "si";}
?>