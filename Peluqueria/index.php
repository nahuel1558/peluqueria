<!DOCTYPE html>
<html>
<head>
  <title>Reserva de Turnos</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script>
    var horariosAbiertos = [];

    function toggleHorarios(dia) {
      var horarios = document.getElementById(dia + '_horarios');
      
      // Cerrar horarios abiertos previamente
      horariosAbiertos.forEach(function(horario) {
        if (horario !== horarios) {
          horario.style.display = 'none';
        }
      });
      
      if (horarios.style.display === 'none') {
        horarios.style.display = 'block';
        horariosAbiertos.push(horarios);
      } else {
        horarios.style.display = 'none';
        var index = horariosAbiertos.indexOf(horarios);
        if (index !== -1) {
          horariosAbiertos.splice(index, 1);
        }
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Reserva de Turnos</h1>
    <table>
      <tr>
        <?php
        $startHour = 8; // Hora de inicio (8 am)
        $endHour = 20;  // Hora de fin (8 pm)
        $interval = 30; // Intervalo de 30 minutos

        ?>
      </tr>

      <tr>
        <?php
        $diasSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');

        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "peluqueria";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Consulta para obtener los turnos ocupados
        $turnosOcupados = array();
        $sql = "SELECT dia, hora FROM turnos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $turnosOcupados[$row["dia"]][] = $row["hora"];
          }
        }
        // Generar celdas para los días de la semana
        foreach ($diasSemana as $dia) {
          echo "<td><a href='javascript:void(0);' onclick='toggleHorarios(\"$dia\");'>$dia</a></td>";
        }
        ?>
      </tr>
    </table>

    <?php
    // Generar celdas para los días de la semana (ocultas)
foreach ($diasSemana as $dia) {
  echo "<div class='horarios' id='" . $dia . "_horarios' style='display: none;'>";
  echo "<h2>$dia</h2>";
  echo "<ul>";

  if (isset($turnosOcupados[$dia]) && is_array($turnosOcupados[$dia])) {
    $horariosOcupados = $turnosOcupados[$dia]; // Agrega esta línea
    
    foreach ($horariosOcupados as $horaOcupada) {
      echo "<li class='ocupado'>$horaOcupada</li>";
    }
  }

  for ($hour = $startHour; $hour <= $endHour; $hour++) {
    for ($minute = 0; $minute < 60; $minute += $interval) {
      $time = sprintf("%02d:%02d", $hour, $minute);
      $ocupado = isset($horariosOcupados) && in_array($time, $horariosOcupados) ? 'class="ocupado"' : '';
      
      // Verificar si el horario ya fue solicitado
      if (!isset($horariosOcupados) || !in_array($time, $horariosOcupados)) {
        echo "<li $ocupado><a href='reservar_turno.php?dia=$dia&hora=$time'>$time</a></li>";
      }
    }
  }
  
  echo "</ul>";
  echo "</div>";
}


    $conn->close();
    ?>
  </div>
</body>
</html>
