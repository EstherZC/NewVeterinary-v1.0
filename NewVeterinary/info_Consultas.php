<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

View::start('Consultas');
View::navigation();
function mostrarConsulta($id){
    $user = User::getLoggedUser();
    $res = DB::execute_sql("SELECT * FROM consultas where id=\"{$id}\";");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $consulta = $res->fetch();
    $res = DB::execute_sql("SELECT * FROM mascotas where id=\"{$consulta['idmascota']}\";");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $mascota = $res->fetch();
    if($user['tipo']==1){
        $res = DB::execute_sql("SELECT * FROM usuarios where id=\"{$mascota['idpropietario']}\";");
        $res->setFetchMode(PDO::FETCH_NAMED); 
        $propietario = $res->fetch();

        echo "<div id='infoConsulta' class='info'>
            <h3>{$mascota['nombre']}</h3>
            <ul>
            <li>Asunto: {$consulta['asunto']}</li>
            <li>Descripción: {$consulta['descripcion']}</li>
            <li>Fecha: {$consulta['fecha']}</li>
            <li>Especie: {$mascota['especie']}</li>
            <li>Propietario: {$propietario['nombre']}</li>
            <li>Teléfono: {$propietario['telefono']}</li>
        </ul></div>";
    }else{
        $res = DB::execute_sql("SELECT * FROM veterinario;");
        $res->setFetchMode(PDO::FETCH_NAMED); 
        $veterinario = $res->fetch();
        echo "<div class='info'>
            <h3>{$mascota['nombre']}</h3>
            <ul>
            <li>Asunto: {$consulta['asunto']}</li>
            <li>Descripción: {$consulta['descripcion']}</li>
            <li>Fecha: {$consulta['fecha']}</li>
            <li>Teléfono Veterinario: {$veterinario['contacto']}</li>
        </ul></div>";
    }
}
mostrarConsulta($_REQUEST['id']);
View::end();