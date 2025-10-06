<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes - Estudio RVP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Lista de Clientes - Estudio RVP</h1>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la conexión
$host = "estudioRVP";
$port = "3306";
$user = "root";
$pass = "root";
$dbname = "Estudio";

// Conectar a MySQL
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("<p class='error'> Error de conexión: " . $conn->connect_error . "</p>");
}

echo "<p class='success'> Conectado a la base de datos '$dbname'</p>";

// Consultar la tabla clientes
$sql = "SELECT id, nombre, apellido, email FROM clientes ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<p>Se encontraron <strong>" . $result->num_rows . "</strong> cliente(s)</p>";
    
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["apellido"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p> No hay clientes registrados en la base de datos.</p>";
}

$conn->close();
?>

</body>
</html>
