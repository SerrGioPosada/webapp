<?php
if ( isset($_POST['email-username']) && isset($_POST['password']) ) {
    $usuario->setEmail($_POST['email-username']);
    if ( $usuario->existeNombreUsuario($sgbd, $usuario->getEmail()) ) {
        $password = md5( $_POST['password'] );
        if ( $password==$usuario->getPassword() ) {
            session_start();
            $_SESSION['idUsuario']=$usuario->getIdUsuario();
            $_SESSION['email']=$usuario->getEmail();
            $_SESSION['nivelAcceso']=$usuario->getNivelAcceso();
        }
        else{
            //Contraseña invalida
            header ("Location: login.php?e=p" );
            exit();
        }
    }
    else{
        //usuario no existe
        header ("Location: login.php?e=u");
        exit();
    }
}
else {
    session_start();
    if ( !isset($_SESSION['email']) ){
        //Acceso inválido
        session_destroy();
        header ("Location: login.php?e=i");
        exit();
    }
}
?>
