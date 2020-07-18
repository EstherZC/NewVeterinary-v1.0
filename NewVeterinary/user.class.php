<?php
include_once 'presentation.class.php';
include_once 'data_access.class.php';

$user= User::getLoggedUser();

View::start($user['nombre']);
View::navigation();

if($user['tipo'] == 1){
    $res = DB::execute_sql('SELECT * FROM consultas;');
    $res->setFetchMode(PDO::FETCH_NAMED); 

    $datos = $res->fetchAll();

    echo "<div id='consulta'>
          <table>
          <tr>
            <th>Nombre</th>
            <th>Asunto</th>
            <th>Fecha</th>
          </tr>";
    foreach($datos as $registro){
        echo "<tr>";
        $res1 = DB::execute_sql("SELECT * FROM mascotas where id=\"{$registro['idmascota']}\";");
        $res1->setFetchMode(PDO::FETCH_NAMED); 
        $mascota = $res1->fetch();
        echo "<td>{$mascota['nombre']}</td>";
        echo "<td>{$registro['asunto']}</td>";
        echo "<td>{$registro['fecha']}</td>";
        echo "<td><a href='info_Consultas.php?id={$registro['id']}'>Ver</a></td>
        </tr>";  
    }
    echo "</table></div>";
}else{
  $res = DB::execute_sql("SELECT * FROM mascotas where idpropietario=\"{$user['id']}\";");
  $res->setFetchMode(PDO::FETCH_NAMED); 
  $datos = $res->fetchAll();
  echo "<div class='info' id='mascota_User'>
        <h3>Mascotas</h3>
        <table>
          <tr>
            <th></th>
            <th>Nombre</th>
            <th>Consultas</th>
          </tr>";
  foreach($datos as $mascota){
    $imgb64 = View::imgtobase64($mascota['imagen']);
    echo "<tr>
          <td><img id='imgMascotaUser' src='$imgb64'></td>
          <td>{$mascota['nombre']}</td>
          <td>";
    $res = DB::execute_sql("SELECT * FROM consultas where idmascota=\"{$mascota['id']}\";");
    $res->setFetchMode(PDO::FETCH_NAMED); 
    $datos1 = $res->fetchAll();
    if(!empty($datos1)){
      foreach($datos1 as $consulta){
        echo "<p><a href='info_Consultas.php?id={$consulta['id']}'>{$consulta['asunto']}</a></p>";
      }
    }
    echo "</td>
        </tr>";
  }

}
View::end();