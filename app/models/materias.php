<?php
  require_once("../config/database.php");

  class Materias{

    private $conexion;

    public function __construct() { 
      $this->conexion = Database::getconexion();
    
    }

    public function getAll(): array {
      $sql = "SELECT * FROM vista_materias_todo";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
    
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result; 
    }
    
    public function add($params =[]): int {
      $sql = "CALL spu_materias_insertar(?,?,?,?,?,?,?)";
    
      $stm = $this->conexion->prepare($sql);
      $stm->execute(
        array(
          $params ["id_Categoria"],
          $params ["Materia"],
          $params ["Titulo"],
          $params ["Duracion_Horas"],
          $params ["Nivel"],
          $params ["Precio"],
          $params ["Fecha_Inicio"],
        ));
        return $stm->rowCount();
    }
    public function edit($params = []): int {
      $sql = "UPDATE Materias SET id_Categoria=?, Materia=?,Titulo=?, Duracion_Horas=?,Nivel=?, Precio=?,Fecha_Inicio=? WHERE id_Materia=?";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute( [
      $params ["id_Categoria"],
      $params ["Materia"],
      $params ["Titulo"],
      $params ["Duracion_Horas"],
      $params ["Nivel"],
      $params ["Precio"],
      $params ["Fecha_Inicio"],
      $params ["id_Materia"],
      ]);
    return $stmt->rowCount();
  }
  public function delete($params = []):int{
    $sql = "DELETE FROM Materias WHERE id_Materia=?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["id_Materia"]
      )
    );
    return $stmt->rowCount();
  }
  public function getById($id):array{
    $sql = "SELECT * FROM Materias WHERE id_Materia=?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($id)
    );
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } 
  
  }