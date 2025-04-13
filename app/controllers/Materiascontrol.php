<?php
// Verifica que el archivo se esté ejecutando correctamente
if (isset($_SERVER['REQUEST_METHOD'])) {

    require_once "../models/Materias.php"; // Asegúrate de que la ruta sea correcta

    $materias = new Materias(); // Instancia la clase

    // Acción de acuerdo al tipo de solicitud HTTP
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            header('Content-Type: application/json');

            // Verifica la tarea que se solicita
            if ($_GET['task'] == 'getAll') {
                // Devuelve todas las materias
                echo json_encode($materias->getAll());
            } else if ($_GET['task'] == 'getById') {
                // Devuelve una materia por su ID
                echo json_encode($materias->getById($_GET['id_Materia']));
            }
            break;

        case 'POST':
            // Recibe los datos en formato JSON
            $input = file_get_contents('php://input');
            $dataJSON = json_decode($input, true);

            // Datos a insertar en la base de datos
            $insetar = [
                'id_Categoria' => $dataJSON['id_Categoria'],
                'Materia' => $dataJSON['Materia'],
                'Titulo' => $dataJSON['Titulo'],
                'Duracion_Horas' => $dataJSON['Duracion_Horas'],
                'Nivel' => $dataJSON['Nivel'],
                'Precio' => $dataJSON['Precio'],
                'Fecha_Inicio' => $dataJSON['Fecha_Inicio'],
            ];

            // Inserta los datos en la base de datos
            $filasAfectadas = $materias->add($insetar);

            header('Content-Type: application/json');
            echo json_encode(["filas" => $filasAfectadas]);
            break;

        case 'DELETE':
            header('Content-Type: application/json');

            // Recupera el ID de la materia desde la URL
            $url = $_SERVER['REQUEST_URI'];
            $arrayURL = explode('/', $url);
            $idMateria = end($arrayURL);

            // Elimina la materia de la base de datos
            $filasAfectadas = $materias->delete(['id_Materia' => $idMateria]);

            echo json_encode(["filas" => $filasAfectadas]);
            break;
    }
}
