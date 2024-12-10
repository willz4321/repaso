<?php
   session_start();
   require("conexion.php");
   $conexion = conectar();

   if ($conexion && !empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $username = $_POST['usuario'];
    $password = sha1($_POST['clave']); 

    $query = "SELECT foto, usuario FROM periodistas WHERE usuario = ? AND clave = ?";
    $resultado = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($resultado, "ss", $username, $password);
    mysqli_stmt_execute($resultado);
    mysqli_stmt_bind_result($resultado, $foto, $usuario);        
    mysqli_stmt_store_result($resultado);
    $cantFilas = mysqli_stmt_num_rows($resultado);
    if ($cantFilas == 1) {
        mysqli_stmt_fetch($resultado);
        echo '<p>Sera redirigido</p>';
        echo '<img src="../img/usuarios/'. $foto .'" alt="Foto" class="img-fluid" style="max-width: 100px;">';

        $_SESSION['usuario'] = $usuario;
        $_SESSION['foto'] = $foto;
        header("refresh:3;url=periodista_verificado.php");
        exit();
    } else {
        echo '<p class="text-danger">Nombre de usuario o contraseña incorrectos. Serás redirigido al inicio de sesión.</p>';
        header("refresh:10;url=../index.php"); 
        exit();
    }
   }
?>