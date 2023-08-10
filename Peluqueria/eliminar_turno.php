<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET["id"];

  // Conexión a la base de datos (modificar según corresponda)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "peluqueria";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Eliminar el turno de la base de datos
  $sql = "DELETE FROM turnos WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    echo "Turno eliminado exitosamente.";
  } else {
    echo "Error al eliminar turno: " . $conn->error;
  }

  $conn->close();
}
?>
<script>
  // Redirigir nuevamente a la página admin.php después de 2 segundos
  setTimeout(function() {
    window.location.href = "admin.php";
  }, 1000); // Cambiar a la cantidad de milisegundos que desees
</script>