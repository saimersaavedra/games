<?php
include "dbConnection.php";

try{
  $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
  if(!$conn)
  {
    echo '{"codigo":400, "mensaje":"error ando conectar", "respuesta":""}';
  }
  else {
    if(
        isset($_POST['user']) &&
        isset($_POST['descripcion']) &&
        isset($_POST['evasion']) &&
        isset($_POST['penalizacion']) &&
        isset($_POST['puntaje']))
        {
          $user                  = $_POST['user'];
          $descripcion           = $_POST['descripcion'];
          $evasion               = $_POST['evasion'];
          $penalizacion          = $_POST['penalizacion'];
          $puntaje               = $_POST['puntaje'];



          $sql = "SELECT * FROM `usuario` WHERE user = '".$user."';";
          $resultado = $conn->query($sql);
          if($resultado->num_rows > 0)
          {
            $sql = "UPDATE `usuario` SET `descripcion` = '".$descripcion."', `evasion` = '".$evasion."',
`penalizacion` = '".$penalizacion."', `puntaje` = '".$puntaje."' WHERE user = '".$user."';";
            if($conn->query($sql) === true)
            {
              $sql = "SELECT * FROM `usuario` WHERE user = '".$user."';";
              $resultado = $conn->query($sql);
              $texto = '';

              while($row = $resultado->fetch_assoc())
              {
                $texto ="#user#:#".$row['user'].
                    "#,#descripcion#:".$row['descripcion'].
                    "#,#evasion#:".$row['evasion'].
                    ",#penalizacion#:".$row['penalizacion'].
                    ",#puntaje#:".$row['puntaje'].
                    "}";
              }
              echo '{"codigo":208, "mensaje":"se han actualizado correctamente los datos", "respuesta":"'.$texto.'"}';

            }
            else
            {
              echo '{"codigo":401, "mensaje":"error conexion", "respuesta":""}';
            }
          }
          else
          {
            echo '{"codigo":403, "mensaje":"No existe este usuario", "respuesta":"'.$resultado->num_rows.'"}';
          }
        }
        else{
            echo '{"codigo":402, "mensaje":"faltan datos para ejecutar la acción solicitada", "respuesta":""}';
    }
  }
}
catch(Exception $e)
{
  echo '{"codigo":400, "mensaje":"error intentando ", "respuesta":""}';
}


include 'footer.php';
