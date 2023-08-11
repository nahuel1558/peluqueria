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
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "peluqueria";
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }
      
      $sql = "SELECT * FROM turnos";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $nombre = $row["nombre"];
          $dia = $row["dia"];
          $hora = $row["hora"];
          $id = $row["id"];
          echo "<tr>";
          echo "<td>$dia</td>";
          echo "<td>$hora</td>";
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
