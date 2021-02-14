<?php
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);

  $dniPac = "87173605-I";
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Listado de tratamientos</title>
  <link href="styles/estiloPacientes.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
</head>

<body class="htmlNoPages">
  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de paciente</h4>
  <nav id="menu-superior">
    <ul>
      <li class="gwd-p-gv4z"><a href="listaConsultasPaciente.php?id=<?php echo $IDPaciente?>">Mis tratamientos</a></li>
      <li class="gwd-p-gv4z gwd-p-1qhn"><a href="hacerConsulta.php?IDPaciente=<?php echo $IDPaciente?>">Mis seguimientos diarios</a></li>
      <li class="gwd-p-gv4z gwd-p-5vs1"><a href="perfilPaciente.php?id=<?php echo $IDPaciente?>"><id="PerfilPaciente">Datos personales</a></li>
      <li class="gwd-p-gv4z salir"><a href="login.php">Salir</a></li> 
    </ul>
  </nav>
 
  
  <div class = "Listado_tratamientos_paciente">

    <h1>Listado de tratamientos</h1>
    <br> </br>
    <div>
    <table class = "tablaListadoTratamientosPaciente">
            <tr>
                <th> Fecha de inicio </th>
                <th> Fecha de fin </th>
                <th> Tipo </th>
                <th> Ver perfil del tratamiento </th>
            </tr>
        <?php
             
             $collection1 = $mongo->ScAid->Treatments;
             $result = $collection1->find(['Patient_DNI' => $dniPac])->toArray();

             foreach ($result as $treatment) {
                 echo '
                   <tr>
                       <td>'.$treatment['Date_start'].'</td>
                       <td>'.$treatment['Date_end'].'</td>
                       <td>'.$treatment['Type'].'</td>
                       <td>
                         <form action="perfilTratamientoPaciente.php" method = "post">
                           <input type="hidden" name="dniPac" value= '.$dniPac.'>
                           <input type="hidden" name="idTreatment" value= '.$treatment['_id'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';

               }
               if(count($result) == 0){
                echo '<tr><td colspan = "4">No hay resultados</td></tr>';
               }

               ?>

        </table>
        <br> </br>
        <h1>Listado de corset</h1>
        <br> </br>
        <table class = "tablaListadoCorsetPaciente">
            <tr>
                <th> Tipo </th>
                <th> Material </th>
                <th> Medidas </th>
                <th> Descripción </th>
            </tr>
        <?php
             
             $collection2 = $mongo->ScAid->Braces;
             $result = $collection2->find(['Patient_DNI' => $dniPac])->toArray();

             foreach ($result as $brace) {
                 echo '
                   <tr>
                       <td>'.$brace['Type'].'</td>
                       <td>'.$brace['Material'].'</td>
                       <td>
                       <ul>
                       <li> Cadera:: '.$brace['Measures']['Hip_measure'].'</li>
                       <li> Cintura: '.$brace['Measures']['Waist_measure'].'</li>
                       <li> Torax: '.$brace['Measures']['Thorax_measure'].'</li>
                       <ul>
                       </td>
                       <td>'.$brace['Description'].'</td>
                   </tr>';

               }
               if(count($result) == 0){
                echo '<tr><td colspan = "4">No hay resultados</td></tr>';
               }

               ?>

        </table>
    </div>
  </div>
  
  
</body>

</html>

