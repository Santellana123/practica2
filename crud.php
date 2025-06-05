<?php
include 'bd.php';

if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $anio = $_POST['anio'];
    $genero = $_POST['genero'];
    $conexion->query("INSERT INTO libros (titulo, autor, año, genero) VALUES ('$titulo', '$autor', $anio, '$genero')");
    header("Location: crud.php");
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $anio = $_POST['anio'];
    $genero = $_POST['genero'];
    $conexion->query("UPDATE libros SET titulo='$titulo', autor='$autor', anio=$anio, genero='$genero' WHERE id=$id");
    header("Location: crud.php");
}
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM libros WHERE id=$id");
    header("Location: crud.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Biblioteca</title>
</head>
<body>
    <h1>Gestión de Libros</h1>
    <?php
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $libro = $conexion->query("SELECT * FROM libros WHERE id=$id")->fetch_assoc();
    ?>
        <h2>Editar Libro</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">
            Título: <input name="titulo" value="<?= $libro['titulo'] ?>"><br>
            Autor: <input name="autor" value="<?= $libro['autor'] ?>"><br>
            Año: <input type="number" name="anio" value="<?= $libro['anio'] ?>"><br>
            Género: <input name="genero" value="<?= $libro['genero'] ?>"><br>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php
    } else {
    ?>
        <h2>Agregar Libro</h2>
        <form method="post">
            Título: <input name="titulo"><br>
            Autor: <input name="autor"><br>
            Año: <input type="number" name="anio"><br>
            Género: <input name="genero"><br>
            <input type="submit" name="agregar" value="Guardar">
        </form>
    <?php } ?>

    <h2>Lista de Libros</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Título</th><th>Autor</th><th>Año</th><th>Género</th><th>Acciones</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM libros");
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['titulo']}</td>
                <td>{$fila['autor']}</td>
                <td>{$fila['año']}</td>
                <td>{$fila['genero']}</td>
                <td>
                    <a href='crud.php?editar={$fila['id']}'>Editar</a> |
                    <a href='crud.php?eliminar={$fila['id']}'>Eliminar</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>