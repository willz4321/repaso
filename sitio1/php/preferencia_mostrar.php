<?php
if (isset($_COOKIE['mi-tipo'])) {
    $categoriaSeleccionada = $_COOKIE['mi-tipo'];

    echo "Tu categoría preferida es: " . htmlspecialchars($categoriaSeleccionada);
} else {
    echo "No se ha configurado ninguna categoría preferida.";
}
?>
