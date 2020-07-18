<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

View::start('Historial');
View::navigation();
function mostrarHistorial($id){
    $res = DB::execute_sql("SELECT * FROM mascotas where id=\"$id\";");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $mascota = $res->fetch();
    $imgb64 = View::imgtobase64($mascota['imagen']);

    echo "<div  class='info'>
        <h3>{$mascota['nombre']}</h3>";
    echo "<img id='imgMascotas' src='$imgb64'>";
    echo "<ul>
          <li>Especie: {$mascota['especie']}</li>
          <li>Raza: {$mascota['raza']}</li>
          <li>Sexo: {$mascota['sexo']}</li>
          <li>Fecha de Nacimiento: {$mascota['fechaN']}</li>
        </ul>";
    $res = DB::execute_sql("SELECT * FROM usuarios where id=\"{$mascota['idpropietario']}\";");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $propietario = $res->fetch();
    echo "<p>Información Propietario:<p>
        <ul>
          <li>Nombre: {$propietario['nombre']}</li>
          <li>Email: {$propietario['email']}</li>
          <li>Dirección: {$propietario['direccion']}</li>
          <li>Teléfono: {$propietario['telefono']}</li>
        </ul>";
    $res = DB::execute_sql("SELECT * FROM consultas where idmascota=\"{$mascota['id']}\" order by fecha;");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $datos = $res->fetchAll();
    echo "<p>Consultas:<p>";
    echo "<ul>";
    foreach($datos as $registro){
        echo "<li>Asunto: {$registro['asunto']}</li>";
        echo "<li>Descripción: {$registro['descripcion']}</li>";
        echo "<li>Fecha: {$registro['fecha']}</li>";
    }

    echo "</ul></div>";
    echo "<a id='pacientes' href=\"pacientes.php\">Atrás</a>";
}
mostrarHistorial($_REQUEST['id']);

View::end();