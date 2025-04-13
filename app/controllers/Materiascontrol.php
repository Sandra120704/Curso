<?php
if(isset($_SERVER['REQUEST_METHOD'])){

  require_once "../models/materias.php";

  $materias = new Materias();

  switch($_SERVER['REQUEST_METHOD']){
    case 'GET'  :

      header('Content-Type: application/json; charset=utf-8');

      if($_GET['task']='getAll'){
        echo json_encode($materias->getAll() );
      }
      else if($_GET['task']== 'getById'){
        echo json_encode($materias->getById($_GET['id_Materia']));
      }
      break;

      case 'POST':

        $input = file_get_contents('php:/input');
        $dataJSON = json_decode($input,true);

        $insetar = [
          'id_Categoria' => $dataJSON['id_Categoria'],
          'Materia' => $dataJSON['Materia'],
          'Titulo' => $dataJSON['Titulo'],
          'Duracion_Horas' => $dataJSON['Duracion_Horas'],
          'Nivel' => $dataJSON['Nivel'],
          'Precio' => $dataJSON['Precio'],
          'Fecha_Inicio' => $dataJSON['Fecha_Inicio'],
        ];

        $filasAfectadas = $materias->add($insetar);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["filas" => $filasAfectadas]);
        break;
        case "DELETE":
          header('Content-Type: application/json');
          echo json_encode(["success"=>true]);

          $url = $_SERVER['REQUEST_URI'];
          $arrayURL = explode('/', $url);
          $idMateria = end($arrayURL);
          $filasAfectadas = $materias -> delete(['id_Materia'=>$idMateria]);
          echo json_encode(["filas"=>$filasAfectadas]);
          break;
    }  
    
}