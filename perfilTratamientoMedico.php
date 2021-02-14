<?php
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);
  $idTreatment = isset($_POST['idTret']) ? $_POST['idTret'] : null;
  $dniMed = isset($_POST['dniMed']) ? $_POST['dniMed'] : null;


?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>Listado de tratamientos</title>
  <link href="styles/estiloMedicos.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
</head>

<body class="htmlNoPages">
  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de médico</h4>
  <nav id="menu-superior">
            <ul>
                <li class="gwd-p-gv4z">
                    <form action="listaPacientesMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input class = "botonListaPacientes" type="submit" value="Lista de Pacientes" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z gwd-p-5vs1">
                    <form action="login.php" method = "post">
                            <!-- <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input type="hidden" name="dniPac" value= <?php $seguimiento['Patient_DNI'] ?>> -->
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
                </li>
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