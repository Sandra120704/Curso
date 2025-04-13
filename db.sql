CREATE DATABASE Curso; -- Base De Datos

use Curso;

-- Creacion De Tablas 

CREATE TABLE Categorias
(
    id_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    Categoria VARCHAR(30) NOT NULL
) ENGINE = INNODB; 

INSERT INTO Categorias (Categoria) VALUES
		('Matematica'),
		('Literatura'),
		('Informatica');
        
CREATE TABLE Materias (
    id_Materia INT AUTO_INCREMENT PRIMARY KEY,
    id_Categoria INT NOT NULL,
    Materia VARCHAR(30) NOT NULL,
    Titulo VARCHAR(50) NOT NULL,
    Duracion_Horas TIME,
    Nivel VARCHAR(30) NOT NULL,
    Precio DECIMAL(10,2),
    Fecha_Inicio DATE,
    CONSTRAINT FK_idcategoria_cat FOREIGN KEY (id_Categoria) REFERENCES Categorias(id_Categoria)
) ENGINE = INNODB;


INSERT INTO Materias (id_Categoria, Materia, Titulo, Duracion_Horas, Nivel, Precio, Fecha_Inicio) VALUES
	(1, 'Matematica','Ecuaciones','02:30:00','Basico',15.00,'2025-01-11'),
    (2, 'Literatura','Verbos','03:30:00','Basico',25.00,'2025-03-11'),
    (3, 'Informatica','Hardware','01:30:00','Intermedio',35.00,'2025-02-10'),
    (1, 'Matematica','Fracciones','02:30:00','Avanzado',45.00,'2025-01-10'),
    (2, 'Literatura','La Odisea','04:30:00','Intermedio',55.00,'2025-02-11'),
    (3, 'Informatica','Sistemas de Información','03:30:00','Avanzado',65.00,'2025-02-22');
    
SELECT * FROM Categorias;
SELECT * FROM Materias;

CREATE VIEW vista_materias_todo AS
SELECT
    M.id_Materia,
    M.id_Categoria,
    C.Categoria,
    M.Materia,
    M.Titulo,
    M.Duracion_Horas,
    M.Nivel,
    M.Fecha_Inicio
FROM Materias M
INNER JOIN Categorias C ON M.id_Categoria = C.id_Categoria
ORDER BY M.id_Materia;

CREATE PROCEDURE spu_materias_filtrar
BEGIN
	SELECT * FROM vista_materias_todo WHERE 


