<?php
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);
  $idTreatment = isset($_POST['idTreatment']) ? $_POST['idTreatment'] : null;
  $dniPac = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;


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

    <h1> Perfil de un tratamiento </h1>
    <br> </br>
    <div>
    <table class = "tablaPerfilTratamiento" >
        <?php 
        $collection = $mongo->ScAid->Treatments;
        $treatment = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($idTreatment)]);
        echo'
        <tr>
            <th> Fecha de inicio </th>
            <td>'.$treatment['Date_start'].' </td>
        </tr>
        <tr>
            <th> Fecha de fin </th>
            <td> '.$treatment['Date_end'].' </td>
        </tr>
        <tr>
            <th> Tipo </th>
            <td> '.$treatment['Type'].'</td>
        </tr>
        <tr>
            <th> Descripción </th>
            <td> '.$treatment['Description'].'</td>
        </tr>';
        
        ?>
        </table>
    </div>
  </div>
  
  
</body>

</html>