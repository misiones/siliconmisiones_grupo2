<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
// Database connection parameters.

$servername = "sistemasmisiones.com.ar";
$username = "uv028960_res";
$password = "reservas2021";
$database = "uv028960_reservas";
$user=$_POST['username'];  
$pass=$_POST['psw']; 
#echo $user.$pass; 
  
$mysqli = new mysqli($servername, $username, $password, $database);
      if ($mysqli->connect_errno) {
                        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }else{//echo "si";

echo $mysqli; 

$query=mysqli_query($mysqli, "SELECT * FROM usuarios WHERE nick='".$user."' AND password='".$pass."'");  
    $numrows=mysql_num_rows($query);  
#echo $numrows;
if($numrows!=0)  
    {  
    while($row=mysql_fetch_assoc($query))  
    {  
        $dbusername=$row['nick'];  
        $dbpassword=$row['password']; 
    }
    #echo $dbusername.$dbpassword;
    if($user == $dbusername && $pass == $dbpassword)  
    {  
        echo "Valid User .. Successfully Logged In !!";  
    } else {  
        echo "Invalid Username or password!";  
    } 
    }
?>
</body>
</html>