<?php
    require_once 'conexion.php';
    $conexion = conectar();

 if ($conexion && !empty($_POST['categoria']) && !empty($_FILES['foto']) && !empty($_POST['contenido']) && !empty($_POST['titulo']) && !empty($_POST['fecha_publicacion'])) {
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $contenido = $_POST['contenido'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $foto = '';

    if (!empty($_FILES['foto']['size'])) { 
        $foto = $_FILES['foto']['name'];
        $ruta_temp = $_FILES['foto']['tmp_name'];
        $ruta_carpeta = '../img/noticias/'; 
        $ruta_destino = $ruta_carpeta . $foto;
    
        if (!is_dir($ruta_carpeta)) {
            if (!mkdir($ruta_carpeta, 0755, true)) {
                echo "Error: No se pudo crear la carpeta de destino.";
                exit;
            }
        }
    
        if (file_exists($ruta_destino)) {
            echo "Error: Ya existe un archivo con el mismo nombre en la carpeta de destino.";
        } else {
            if (move_uploaded_file($ruta_temp, $ruta_destino)) {
                echo "El archivo se ha subido correctamente.";
            } else {
                echo "Error: No se pudo mover el archivo a la carpeta de destino.";
            }
        }
    } else {
        echo "Error: No se ha subido ningún archivo.";
    }    

    $query = "INSERT INTO noticias (titulo, contenido, foto, categoria, fecha_publicacion) VALUES (?, ?, ?, ?, ?)";
    $res = mysqli_prepare($conexion, $query);

    if ($res) {
        mysqli_stmt_bind_param($res, 'sssss', $titulo, $contenido, $foto, $categoria, $fecha_publicacion);

        if (mysqli_stmt_execute($res)) {
            echo "Artículo agregado con éxito.";

            header("refresh:3;url=../index.php"); 
        } else {
            echo "Error al agregar el artículo: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($res);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "Error al hacer consulta!!.";
}
    
?>