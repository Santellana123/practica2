<?php include 'bd.php'; ?>
<h1>Lista de Libros</h1>
<a href="crud.php">CRUD</a>
<table >
  <tr>
    <th>ID</th><th>Título</th><th>Autor</th><th>Año</th><th>Género</th><th>Acciones</th>
  </tr>
  <?php
  $result = $conexion->query("SELECT * FROM libros");
  while ($libro = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$libro['id']}</td>
        <td>{$libro['titulo']}</td>
        <td>{$libro['autor']}</td>
        <td>{$libro['año']}</td>
        <td>{$libro['genero']}</td>
        <td>
          <a href='editar.php?id={$libro['id']}'>Editar</a> | 
          <a href='eliminar.php?id={$libro['id']}'>Eliminar</a>
        </td>
      </tr>";
  }
  ?>
</table>S