<?php
require("conexion.php");
$conexion = conectar();

if ($conexion && !empty($_POST['usuario']) && !empty($_POST['especialidad']) && !empty($_POST['fecha_alta']) && !empty($_POST['id'])) {
    $usuario = $_POST['usuario'];
    $especialidad = $_POST['especialidad'];
    $fecha_alta = $_POST['fecha_alta'];
    $id_periodista = $_POST['id'];

    $query = "UPDATE periodistas SET usuario = ?, especialidad = ?, fecha_alta = ? WHERE id_periodista = ?";
    $res = mysqli_prepare($conexion, $query);

    if ($res) {
        mysqli_stmt_bind_param($res, 'sssi', $usuario, $especialidad, $fecha_alta, $id_periodista);

        if (mysqli_stmt_execute($res)) {
            echo "Artículo actualizado con éxito.";
            header("refresh:3;url=../index.php");
            exit(); 
        } else {
            echo "Error al actualizar el artículo: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($res);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "Error: Falta información o conexión a la base de datos.";
}
?>
