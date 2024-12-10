<?php
    $ruta = '';
    require_once 'php/encabezado.php';
    require("php/conexion.php");
    require("php/funciones.php");

    $conexion = conectar();

?>
    <section class="row justify-content-center">
        
        <article class="container mt-4 w-75">
            <table class="table table-striped table-bordered text-center table-fixed">
                <thead class="table-dark">
                <tr>
                    <th class="col-3">Usuario</th>
                    <th class="col-3">Especialidad</th>
                    <th class="col-3">Fecha de Alta</th>
                    <th class="col-3">Foto</th>
                    <th class="col-3">Modificar</th>
                </tr>
                </thead>
                <tbody>
                
                <!-- programar debajo de aquí, debe mostrar los datos de la tabla -->
               <?php
                    $query = "SELECT usuario, id_periodista, foto, especialidad, fecha_alta FROM periodistas";
            
                    $resultado = mysqli_prepare($conexion, $query);

                    if (!$resultado) {
                        die("Error en la preparación de la consulta: " . mysqli_error($conexion));
                    }
                    mysqli_stmt_execute($resultado);
                    mysqli_stmt_store_result($resultado);
            
                    if (mysqli_stmt_num_rows($resultado) > 0) {
                        mysqli_stmt_bind_result($resultado, $usuario, $id_periodista, $foto, $especialidad, $fecha_alta); 
            
                        while (mysqli_stmt_fetch($resultado)) {
                       echo ' <tr>
                            <td>'. $usuario .'</td>
                            <td>'. $especialidad .'</td>
                            <td>'. formatearFecha($fecha_alta) .'</td>
                            <td><img src="img/usuarios/'.$foto.'" alt="Foto de '.$usuario.'" class="img-thumbnail img-fluid w-75"></td>
                            <td>
                             <a href="php/periodista_modificar.php?id='.$id_periodista.'">
                               <img src="img/modificar.png" class="img-thumbnail img-fluid w-75">
                             </a>
                            </td>
                        </tr>';
                      }
                    } else {
                        echo '<tr><td colspan="4">No hay artículos disponibles.</td></tr>';
                    }
               ?> 
                </tbody>
            </table>
        </article>
    </section>

<?php
    require_once 'php/pie.php';
?>