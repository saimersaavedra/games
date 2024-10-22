<?php
include "dbConnection.php";

try{
  $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
  if(!$conn)
  {
    echo '{"codigo":400, "mensaje":"error intentando conectar", "respuesta":""}';
  } else {
    if( isset($_POST['user']))
        {
          $user             = $_POST['user'];

          $sql = "SELECT * FROM `usuario` WHERE user = '".$user."';";
          $resultado = $conn->query($sql);
          if($resultado->num_rows > 0)
          {
            echo '{"codigo":202, "mensaje":"usuario existe en el sistema", "respuesta":"'.$resultado->num_rows.'"}';
          }
          else
          {
            echo '{"codigo":203, "mensaje":"usuario no existe", "respuesta":"0"}';
          }
        }
        else{
            echo '{"codigo":402, "mensaje":"faltan datos para ejecutar la acción solicitada", "respuesta":""}';
        }
  }
}
catch(Exception $e)
{
  echo '{"codigo":400, "mensaje":"error intentando conectar", "respuesta":""}';
}


include 'footer.php';
