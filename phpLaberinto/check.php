<?php
include 'dbConnection.php';
try{
  $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
  if(!$conn)
  {
    echo '{"codigo":400, "mensaje":"error intentando conectar", "respuesta":""}';
  } else {
    echo '{"codigo":200, "mensaje":"conectado correctamente", "respuesta":""}';
  }
}
catch(Exception $e)
{
  echo '{"codigo":400, "mensaje":"error intentando conectar", "respuesta":""}';
}


include 'footer.php';
