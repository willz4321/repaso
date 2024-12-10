<?php
    $ruta = '../';
    require_once 'encabezado.php';
    session_start();

    if (!empty($_SESSION['usuario'])) {
        echo '<p class="mb-0 mr-3">' . $_SESSION['usuario'] . '</p>';
        echo '<img class="foto-perfil" src="../img/usuarios/' . $_SESSION['foto'] . '" alt="Foto de perfil">';
    
    } 
    require_once 'pie.php';

?>