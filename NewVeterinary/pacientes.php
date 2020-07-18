<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

View::start('Historial');
View::navigation();
function mostrarPacientes(){
    $res = DB::execute_sql("SELECT * FROM mascotas;");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $datos = $res->fetchAll();
    echo "<div  class='info'>
        <h3>Pacientes</h3>
        <table>
          <tr>
            <th>Nombre</th>
            <th>Propietario</th>
            <th>Telefono</th>
          </tr>";
    foreach($datos as $mascota){
        $res = DB::execute_sql("SELECT * FROM usuarios where id=\"{$mascota['idpropietario']}\";");
        $res->setFetchMode(PDO::FETCH_NAMED); 
        $propietario = $res->fetch();
        echo "<tr>
                <td><a id='historialMascota' href='historial_mascota.php?id={$mascota['id']}'>{$mascota['nombre']}</a>
                </td>
                <td>{$propietario['nombre']}</td>
                <td>{$propietario['telefono']}</td>
            </tr>";
    }
    echo "</div>";
}
mostrarPacientes();

View::end();