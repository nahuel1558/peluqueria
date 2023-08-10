<!DOCTYPE html>
<html>
<head>
  <title>Administrar Turnos</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Administrar Turnos</h1>
    <h2>Turnos Solicitados</h2>
    <table>
      <tr>
        <th>Día</th>
        <th>Hora</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
      <?php
      // Conexión a la base de datos (modificar según corresponda)
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "peluqueria";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Consulta para obtener los turnos solicitados
      $sql = "SELECT * FROM turnos";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $nombre = $row["nombre"];
          $dia = $row["dia"]; // Obtener el día almacenado en la base de datos
          $hora = $row["hora"]; // Obtener la hora almacenada en la base de datos
          $id = $row["id"];
          echo "<tr>";
          echo "<td>$dia</td>"; // Mostrar el día almacenado en la base de datos
          echo "<td>$hora</td>"; // Mostrar la hora almacenada en la base de datos
          echo "<td>$nombre</td>";
          echo "<td><a href='eliminar_turno.php?id=$id'>Eliminar</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No hay turnos solicitados.</td></tr>";
      }

      $conn->close();
      ?>
    </table>
    <br>
    <a href="index.php">Volver</a>
  </div>
</body>
</html>
