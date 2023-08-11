<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET["id"];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "peluqueria";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

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
  setTimeout(function() {
    window.location.href = "admin.php";
  }, 1000);
</script>
