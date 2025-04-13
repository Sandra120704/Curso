<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Materias</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
  
  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-primary text-light">Lista de Materias</div>
      <div class="card-body">
        <table class="table table-striped table-sm" id="tabla-materias">
          <colgroup>
            <col style="width: 4%;">
            <col style="width: 14%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 8%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 14%;">
            <col style="width: 10%;">
          </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Categoría</th>
              <th>Materia</th>
              <th>Título</th>
              <th>Duración</th>
              <th>Nivel</th>
              <th>Precio</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contenido dinámico -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const tabla = document.querySelector("#tabla-materias tbody");

    function obtenerMaterias() {
      fetch(`../../curso/app/controllers/Materiascontrol.php?task=getAll`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
          tabla.innerHTML = "";

          data.forEach(materia => {
            tabla.innerHTML += `
              <tr>
                <td>${materia.id}</td>
                <td>${materia.categoria}</td>
                <td>${materia.materia}</td>
                <td>${materia.titulo}</td>
                <td>${materia.duracion} hrs</td>
                <td>${materia.nivel}</td>
                <td>$${parseFloat(materia.precio).toFixed(2)}</td>
                <td>${materia.fecha_inicio}</td>
                <td>
                  <a href='editar.php?id=${materia.id}' title='Editar' class='btn btn-info btn-sm'><i class="fa-solid fa-pen-to-square"></i></a>
                  <a href='#' title='Eliminar' data-idmateria='${materia.id}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            `;
          });
        })
        .catch(error => console.error("Error al cargar materias:", error));
    }

    document.addEventListener("DOMContentLoaded", () => {
      obtenerMaterias();

      // Delegación para manejar eliminación
      tabla.addEventListener("click", (event) => {
        const enlace = event.target.closest('a');

        if (enlace && enlace.classList.contains('delete')) {
          event.preventDefault();
          const idMateria = enlace.getAttribute('data-idmateria');

          if (confirm("¿Estás seguro de que deseas eliminar esta materia?")) {
            fetch(`../../app/controllers/MateriasController.php?task=delete&id=${idMateria}`, { method: 'GET' })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  alert("Materia eliminada correctamente");
                  obtenerMaterias();
                } else {
                  alert("Error al eliminar la materia");
                }
              })
              .catch(error => console.error("Error:", error));
          }
        }
      });
    });
  </script>

</body>
</html>
