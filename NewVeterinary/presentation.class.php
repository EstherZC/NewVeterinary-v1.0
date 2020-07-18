<?php
include_once 'business.class.php';
class View{
    public static function  start($title){
        $html = "<!DOCTYPE html>
                <html>
                <head>
                <meta charset=\"utf-8\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
                <script src=\"http://code.jquery.com/jquery-1.11.1.js\"></script>
                <script src=\"scripts.js\"></script>
                <title>$title</title>
                </head>
                <body>";
        User::session_start();
        echo $html;
    }

    public static function imgtobase64($img){
        $b64 = base64_encode($img);
        $signature = substr($b64, 0, 3);
        if ( $signature == '/9j') {
            $mime = 'data:image/jpeg;base64,';
        } else if ( $signature == 'iVB') {
            $mime = 'data:image/png;base64,';
        }
        return $mime . $b64;
    }

    public static function navigation(){
        echo '<nav id="top">';
        $user = User::getLoggedUser();
        if($user === false){
            echo "<a href=\"session.class.php\">Sing In</a>";
            echo "<a  href=\"index.php?id='\">Inicio</a>";
        }else{
            if($user['tipo']==2){
                echo "<a  href=\"index.php?id='\">Inicio</a>";
            }else{
                echo "<a href='pacientes.php'>Pacientes</a>";
            }
            echo "<a href=\"user.class.php\">{$user['nombre']}</a>";
            echo "<a href=\"index.php?id=logout\">Sing Out</a>";
        }
        echo '</nav>';
    }

    public static function end(){
        echo '</body></html>';
    }
}