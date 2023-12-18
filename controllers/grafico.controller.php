<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SENATIDB";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejecutar el procedimiento almacenado
$result = $conn->query("CALL spu_empleados_cantsedes()");

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los datos
    $data = array();

    // Obtener los datos y convertirlos a un array asociativo
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Devolver los datos como JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>
