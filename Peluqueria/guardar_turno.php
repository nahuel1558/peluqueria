<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dia = $_POST["dia"];
    $hora = $_POST["hora"];

    // Conexión a la base de datos (modificar según corresponda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "peluqueria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "INSERT INTO turnos (nombre, dia, hora) VALUES ('$nombre', '$dia', '$hora')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Turno solicitado exitosamente. Tu turno es para el $dia a las $hora.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<script>
  // Redirigir nuevamente a la página admin.php después de 2 segundos
  setTimeout(function() {
    window.location.href = "index.php";
  }, 1000);
</script>
