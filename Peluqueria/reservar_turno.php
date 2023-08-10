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
      $dia = $_POST["dia"]; // Obtener el día desde el formulario
      $hora = $_POST["hora"]; // Obtener la hora desde el formulario

      // Conexión a la base de datos (modificar según corresponda)
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "peluqueria";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Insertar turno en la base de datos con día y hora
      $sql = "INSERT INTO turnos (nombre, dia, hora) VALUES ('$nombre', '$dia', '$hora')";
      if ($conn->query($sql) === TRUE) {
        echo "Turno solicitado exitosamente. Tu turno es para el $dia a las $hora.";
      } else {
        echo "Error al solicitar turno: " . $conn->error;
      }

      $conn->close();
    }
    ?>
    <form method="post">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" required>
      <br>
      <input type="hidden" name="dia" value="<?php echo $_GET['dia']; ?>"> <!-- Agregar campo oculto para el día -->
      <input type="hidden" name="hora" value="<?php echo $_GET['hora']; ?>"> <!-- Agregar campo oculto para la hora -->
      <input type="submit" value="Solicitar Turno">
    </form>
    <br>
    <a href="index.php">Volver</a>
    <p>Día: <?php echo $_GET['dia']; ?>, Hora: <?php echo $_GET['hora']; ?></p> <!-- Mostrar día y hora seleccionados -->
  </div>
</body>
</html>
