<?php
    $ruta = '../';
    require_once 'encabezado.php';
    require("conexion.php");
    $conexion = conectar(); 
    if (!$conexion) {
      die("Error al conectar con la base de datos: " . mysqli_connect_error());
  }
    if ($conexion && !empty($_GET['id'])) {
      $id = $_GET['id'];
      $consulta = "SELECT usuario, id_periodista, foto, especialidad, fecha_alta FROM periodistas WHERE id_periodista = ?";
      $sentencia = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($sentencia, 'i', $id);
      mysqli_stmt_execute($sentencia);
      mysqli_stmt_bind_result($sentencia, $usuario, $id_periodista, $foto, $especialidad, $fecha_alta);
      mysqli_stmt_store_result($sentencia);
      
      if (!mysqli_stmt_fetch($sentencia)) {
          echo "<p class='text-white'>Artículo no encontrado.</p>";
          exit;
      }
  } 
?>

<article class="container mt-4">
  <h2>Formulario de Modificación</h2>
   <?php echo '
    <form action="periodista_modificar_ok.php" method="post" enctype="multipart/form-data" class="container mt-3 p-4 col-md-3 bg-info bg-gradient">
      <section class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="'.$usuario.'">
      </section>
      <section class="mb-3">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" value="'.$especialidad.'">
      </section>
      <section class="mb-3">
        <label for="fecha_alta" class="form-label">Fecha de Alta</label>
        <input type="date" class="form-control" id="fecha_alta" name="fecha_alta" value="'.$fecha_alta.'">
      </section>
      <input type="number" class="d-none" name="id" value="'.$id_periodista.'">
      <input type="submit" class="btn btn-primary" value="Actualizar">
    </form>';
    ?>
</article>

<?php
    require_once 'pie.php';
?>