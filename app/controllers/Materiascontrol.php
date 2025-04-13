<?php
if ($_SERVER['REQUEST_METHOD']) {

  require_once "../models/materias.php";

  $materias = new Materias();

  switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
      header('Content-Type: application/json');

      $task = $_GET['task'] ?? '';

      if ($task === 'getAll') {
        echo json_encode($materias->getAll());
      } elseif ($task === 'getById' && isset($_GET['id_Materia'])) {
        echo json_encode($materias->getById($_GET['id_Materia']));
      }
      break;

    case 'POST':
      header('Content-Type: application/json');

      $input = file_get_contents('php://input'); // CORREGIDO: faltaba una barra en php://input
      $dataJSON = json_decode($input, true);

      if ($dataJSON) {
        $insertar = [
          'id_Categoria' => $dataJSON['id_Categoria'],
          'Materia' => $dataJSON['Materia'],
          'Titulo' => $dataJSON['Titulo'],
          'Duracion_Horas' => $dataJSON['Duracion_Horas'],
          'Nivel' => $dataJSON['Nivel'],
          'Precio' => $dataJSON['Precio'],
          'Fecha_Inicio' => $dataJSON['Fecha_Inicio']
        ];

        $filasAfectadas = $materias->add($insertar);
        echo json_encode(["success" => true, "filas" => $filasAfectadas]);
      } else {
        echo json_encode(["success" => false, "error" => "Datos inválidos"]);
      }
      break;

    case 'DELETE':
      header('Content-Type: application/json');

      // Extraer ID de la URL
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = explode('/', $url);
      $idMateria = end($urlParts);

      if (is_numeric($idMateria)) {
        $filasAfectadas = $materias->delete(['id_Materia' => $idMateria]);
        echo json_encode(["success" => true, "filas" => $filasAfectadas]);
      } else {
        echo json_encode(["success" => false, "error" => "ID inválido"]);
      }
      break;
  }
}

