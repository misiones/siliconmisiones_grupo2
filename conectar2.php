
<?php //############## CONEXION A LA BASE ##############
                    //$servername = "localhost";  
                    $servername = "sistemasmisiones.com.ar";
                    //$username = "root";
                    $username = "uv028960_silicon";
                    //$password = "";
                    $password = "silicon1414";
                    //$database = "pruebas_join";
                    $database = "uv028960_telefonia";
                    //$mysql = mysql_connect($db_host, $bd_usuario, $bd_password) or trigger_error(mysql_error(),E_USER_ERROR);
                  
                    $mysqli = new mysqli($servername, $username, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }//else{echo "si";}
?>