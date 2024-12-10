<?php
    $ruta = '';
    require_once 'php/encabezado.php';
    require("php/conexion.php");
    require("php/funciones.php");
   $conexion = conectar();
?>
    <section class="row justify-content-center">
        <!-- programar debajo de aquí, debe mostrar los datos de la tabla -->
    <?php
        $query = "SELECT titulo, contenido, foto, categoria, fecha_publicacion FROM noticias"; 

        $resultado = mysqli_prepare($conexion, $query);

        if (!$resultado) {
            die("Error en la preparación de la consulta: " . mysqli_error($conexion));
        }
        mysqli_stmt_execute($resultado);
        mysqli_stmt_store_result($resultado);

        if (mysqli_stmt_num_rows($resultado) > 0) {
            mysqli_stmt_bind_result($resultado, $titulo, $contenido, $foto, $categoria, $fecha_publicacion); 

            while (mysqli_stmt_fetch($resultado)) {
              echo  '<article class="card mb-4 mx-4 col-md-3">';
                 echo '  <section class="card-body">';
                 echo '  <h2 class="card-title">'. $titulo .'</h2>';
                 echo '    <p class="card-subtitle mb-2">Fecha: '. formatearFecha($fecha_publicacion) .'</p>';
                 echo '    <img src = "img/noticias/'.$foto.'" class="card-img-top">';
                 echo '    <p class="card-text">'. $contenido .'</p>';
                echo '   </section>';
               echo '</article>';
            }
        } else {
            echo '<tr><td colspan="4">No hay artículos disponibles.</td></tr>';
        }

        mysqli_stmt_close($resultado);
        mysqli_close($conexion);
        ?>

    </section>

<?php
    require_once 'php/pie.php';
?>