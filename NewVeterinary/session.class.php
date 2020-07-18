<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

View::start('Sing In');
View::navigation();

class Session{

    public static function login(){
        if(User::login($_REQUEST['login_name'], $_REQUEST['login_password'])){
            header("Location: user.class.php");
            exit();
        }else{
            echo '<p id="error">Nombre de usuario y/o contraseña incorrectos.</p>';
        } 
    }
}

if(array_key_exists('login_name', $_REQUEST)){
    Session::login();
}

echo '<div class="formdiv" id="logindiv">
    <h3>Iniciar sesión</h3>
    <form  method="post">
        <p><input class="form" type="text" name="login_name" placeholder="Usuario"/></p>
        <p><input type="password" name="login_password" placeholder="Contraseña"/></p>
        <p><input type="submit" name="login" value="Acceder"/></p>
    </form>
</div>';
View::end();