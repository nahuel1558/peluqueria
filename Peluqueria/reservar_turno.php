<!DOCTYPE html>
<html>
<head>
  <title>Reservar Turno</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Reservar Turno</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nombre = $_POST["nombre"];
      $dia = $_POST["dia"];
      $hora = $_POST["hora"];

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "peluqueria";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Insertar el turno en la base de datos
$sql_insert = "INSERT INTO turnos (dia, hora, nombre) VALUES ('$dia', '$hora', '$nombre')";
if ($conn->query($sql_insert) === TRUE) {
  echo "Turno solicitado exitosamente.";
} else {
  echo "Error al solicitar el turno: " . $conn->error;
}

// Marcar el horario como ocupado en la lista de horarios ocupados
$turnosOcupados[$dia][] = $hora;

// Redirigir a la página de inicio
header("Location: index.php");

      $conn->close();
    }
    ?>
    <form method="post">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" required>
      <br>
      <input type="hidden" name="dia" value="<?php echo $_GET['dia']; ?>">
      <input type="hidden" name="hora" value="<?php echo $_GET['hora']; ?>">
      <input type="submit" value="Solicitar Turno">
    </form>
    <br>
    <a href="index.php">Volver</a>
    <p>Día: <?php echo $_GET['dia']; ?>, Hora: <?php echo $_GET['hora']; ?></p>
  </div>
</body>
</html>
