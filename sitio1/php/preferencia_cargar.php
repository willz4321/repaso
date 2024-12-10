<?php
if (!empty($_POST['categoria'])) {
    $tipo_categoria = $_POST['categoria'];
    setcookie('mi-tipo', $tipo_categoria, time() + (86400 * 30), "/"); 

    header("refresh:3;url=preferencia_mostrar.php"); 
    exit;
} else {
    echo "Error: No se recibió el tipo de categoría.";
}
?>
