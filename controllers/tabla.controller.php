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
$result = $conn->query("CALL spu_empleados_listado()");

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    echo "<table border='1' class='table table-hover'>
            <tr>
                <th>ID Empleado</th>
                <th>Sede</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>N Documentos</th>
                <th>Fecha Nacimiento</th>
                <th>Teléfono</th>
            </tr>";

    // Mostrar datos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["idempleado"] . "</td>
                <td>" . $row["sede"] . "</td>
                <td>" . $row["apellidos"] . "</td>
                <td>" . $row["nombres"] . "</td>
                <td>" . $row["ndocumentos"] . "</td>
                <td>" . $row["fechaNac"] . "</td>
                <td>" . $row["telefono"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>
