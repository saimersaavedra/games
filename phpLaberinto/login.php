<?php
include "dbConnection.php";

try {
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if (!$conn) {
        throw new Exception("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    if (isset($_POST['user']) && isset($_POST['password'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM `usuario` WHERE user = ? AND password = ?");
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Crear una estructura JSON válida con comillas dobles
            $texto = json_encode([
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "apellido" => $row['apellido'],
                "correo" => $row['correo'],
                "edad" => $row['edad'],
                "user" => $row['user'],
                "password" => $row['password'],
                "descripcion" => $row['descripcion'],
                "evasion" => $row['evasion'],
                "penalizacion" => $row['penalizacion'],
                "puntaje" => $row['puntaje']
            ]);

            echo json_encode([
                "codigo" => 205,
                "mensaje" => "login correcto",
                "respuesta" => $texto
            ]);
        } else {
            echo json_encode([
                "codigo" => 204,
                "mensaje" => "el usuario o la contraseña son incorrectos",
                "respuesta" => "0"
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            "codigo" => 402,
            "mensaje" => "faltan datos para ejecutar la acción solicitada",
            "respuesta" => ""
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "codigo" => 400,
        "mensaje" => $e->getMessage(),
        "respuesta" => ""
    ]);
}

include 'footer.php';
