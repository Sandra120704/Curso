<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Document</title>

</head>
<body>

  <div class="container">

    <form id="formulario-registro" autocomplete="off">

      <div class="card mt-3">
        <div class="card-header bg-primary text-light">Actualizar Registros</div>
        <div class="card-body">

          <div class="form-floating mb-2">
            <select id="id_Categoria" name="id_Categoria" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="1">Programación</option>
              <option value="2">Diseño</option>
              <option value="3">Redes</option>
            </select>
            <label for="id_Categoria">Categoría</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="materia" name="Materia" placeholder="Nombre materia" required>
            <label for="materia">Materia</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="titulo" name="Titulo" placeholder="Título" required>
            <label for="titulo">Título</label>
          </div>

          <div class="form-floating mb-2">
            <input type="number" class="form-control" id="duracion" name="Duracion_Horas" placeholder="Duración en horas" required>
            <label for="duracion">Duración (Horas)</label>
          </div>

          <div class="form-floating mb-2">
            <select id="nivel" name="Nivel" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="Básico">Básico</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>
            </select>
            <label for="nivel">Nivel</label>
          </div>

          <div class="form-floating mb-2">
            <input type="number" class="form-control" id="precio" name="Precio" step="0.01" placeholder="Precio" required>
            <label for="precio">Precio</label>
          </div>

          <div class="form-floating mb-2">
            <input type="date" class="form-control" id="fecha_inicio" name="Fecha_Inicio" required>
            <label for="fecha_inicio">Fecha de Inicio</label>
          </div>

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit">Actuzalizar</button>
          <button class="btn btn-sm btn-secondary" type="reset">Cancelar</button>
        </div>
      </div>
    </form>

  </div>
  
  
</body>
</html>