<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

if(isset($_REQUEST['id']) && $_REQUEST['id']=='logout'){
    User::logout();
}

View::start('NEWVeterinary');
View::navigation();

echo " <div id='logoVeterinario'> <img  src='logo.png' alt='Logo del Veterinario'></div>";
$res = DB::execute_sql('SELECT * FROM veterinario;');
$res->setFetchMode(PDO::FETCH_NAMED); // Establecemos que queremos cada fila como array asociativo

$datos = $res->fetch(); // Leo todos los datos de una vez

echo "<p>{$datos['descripcion']}</p>
    <p>Contacto: {$datos['contacto']}</p>";

View::end();