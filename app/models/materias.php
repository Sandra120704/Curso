<?php

class Materias {
    private $db;

    public function __construct() {
        // Asegúrate de tener una conexión válida a la base de datos
        $this->db = new PDO('mysql:host=localhost;dbname=nombre_base_datos', 'usuario', 'contraseña');
    }

    // Método para obtener todas las materias
    public function getAll() {
        $sql = "SELECT * FROM materias"; // Asegúrate de que la tabla se llame 'materias'
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve las materias como un array asociativo
    }

    // Método para obtener una materia por su ID
    public function getById($id) {
        $sql = "SELECT * FROM materias WHERE id_Materia = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve una sola materia
    }

    // Método para agregar una nueva materia
    public function add($data) {
        $sql = "INSERT INTO materias (id_Categoria, Materia, Titulo, Duracion_Horas, Nivel, Precio, Fecha_Inicio) 
                VALUES (:id_Categoria, :Materia, :Titulo, :Duracion_Horas, :Nivel, :Precio, :Fecha_Inicio)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_Categoria', $data['id_Categoria']);
        $stmt->bindParam(':Materia', $data['Materia']);
        $stmt->bindParam(':Titulo', $data['Titulo']);
        $stmt->bindParam(':Duracion_Horas', $data['Duracion_Horas']);
        $stmt->bindParam(':Nivel', $data['Nivel']);
        $stmt->bindParam(':Precio', $data['Precio']);
        $stmt->bindParam(':Fecha_Inicio', $data['Fecha_Inicio']);

        return $stmt->execute(); // Devuelve verdadero si se insertó correctamente
    }

    // Método para eliminar una materia
    public function delete($data) {
        $sql = "DELETE FROM materias WHERE id_Materia = :id_Materia";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_Materia', $data['id_Materia'], PDO::PARAM_INT);
        return $stmt->execute(); // Devuelve verdadero si se eliminó correctamente
    }
}
